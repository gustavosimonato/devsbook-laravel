<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $loggedUser = Auth::user();

        return view('config', [
            'user' => $loggedUser,
        ]);
    }

    public function save(Request $request)
    {
        $loggedUser = Auth::user();

        if ($request->filled('name') && $request->filled('email')) {
            $name = $request->input('name');
            $birthdate = $request->input('birthdate');
            $email = $request->input('email');
            $city = $request->input('city');
            $work = $request->input('work');
            $password = $request->input('password');

            // E-MAIL
            if ($loggedUser->email != $email) {
                if (!empty(User::where('email', $email)->first())) {
                    $updateFields['email'] = $email;
                } else {
                    return redirect()->route('config')->with('warning', 'E-mail já existe');
                }
            }

            // BIRTHDATE
            $birthdate = explode('/', $birthdate);
            if (count($birthdate) != 3) {
                return redirect()->route('config')->with('warning', 'Data de nascimento inválida!');
            }
            $birthdate = $birthdate[2] . '-' . $birthdate[1] . '-' . $birthdate[0];
            if (strtotime($birthdate) === false) {
                return redirect()->route('config')->with('warning', 'Data de nascimento inválida!');
            }
            $updateFields['birthdate'] = $birthdate;

            // PASSWORD
            if (!empty($password)) {
                $updateFields['password'] = $password;
            }

            // CAMPOS NORMAIS
            $updateFields['name'] = $name;
            $updateFields['city'] = $city;
            $updateFields['work'] = $work;

            // AVATAR
            if ($request->has('avatar')) {
                $request->validate([
                    'avatar' => 'required|image|mimes:jpeg,jpg,png'
                ]);
                $ext = $request->avatar->extension();
                $avatarName = md5(time() . rand(0, 9999)) . '.' . $ext;
                $request->avatar->move(public_path('media/avatars'), $avatarName);
                $updateFields['avatar'] = $avatarName;
            }

            // COVER
            if ($request->has('cover')) {
                $request->validate([
                    'cover' => 'required|image|mimes:jpeg,jpg,png'
                ]);
                $ext = $request->cover->extension();
                $coverName = md5(time() . rand(0, 9999)) . '.' . $ext;
                $request->cover->move(public_path('media/covers'), $coverName);
                $updateFields['cover'] = $coverName;
            }

            if (count($updateFields) > 0) {

                foreach ($updateFields as $fieldName => $fieldValue) {
                    if ($fieldName == 'password') {
                        $fieldValue = password_hash($fieldValue, PASSWORD_DEFAULT);
                    }

                    User::where('id', $loggedUser->id)->update([
                        $fieldName => $fieldValue
                    ]);
                }
            }
        }

        return redirect()->route('config');
    }
}

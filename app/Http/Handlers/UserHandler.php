<?php

namespace App\Http\Handlers;

use \src\handlers\PostHandler;
use Illuminate\Support\Facades\DB;

class UserHandler
{
    public static function verifyLogin($email, $password)
    {
        $user = DB::select('SELECT * FROM users WHERE email = :email LIMIT 1', ['email' => $email]);

        if (!empty($user)) {
            if (password_verify($password, $user[0]->password)) {

                $token = md5(time() . rand(0, 9999) . time());

                DB::update('UPDATE users SET token = :token WHERE email = :email', ['token' => $token, 'email' => $email]);

                return $token;
            }
        }

        return false;
    }

    public static function checkLogin()
    {

        echo $_SESSION['token'];

        if (!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];
            $data = DB::select('SELECT * FROM users WHERE token = :token', [':token' => $token]);
            if (!empty($data) > 0) {
                return $data;
            }
        }
        return false;
    }
}

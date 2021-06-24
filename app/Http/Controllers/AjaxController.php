<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostComment;
use App\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($id)
    {
        $loggedUser = Auth::user();

        $myLike = PostLike::where('id_post', $id)
            ->where('id_user', $loggedUser->id)
            ->get();

        if (count($myLike) > 0) {
            $del_like = PostLike::where('id_post', $id)
                ->where('id_user', $loggedUser->id)
                ->delete();
        } else {
            $add_like = new PostLike;
            $add_like->id_post = $id;
            $add_like->id_user = $loggedUser->id;
            $add_like->save();
        }
    }

    public function comment(Request $request)
    {
        $loggedUser = Auth::user();

        $id = $request->input('id');
        $txt = $request->input('txt');

        $add_comment = new PostComment;
        $add_comment->id_post = $id;
        $add_comment->id_user = $loggedUser->id;
        $add_comment->body = $txt;
        $add_comment->save();

        $array['link'] = '/perfil/' . $loggedUser->id;
        $array['avatar'] = '/media/avatars/' . $loggedUser->avatar;
        $array['name'] = $loggedUser->name;
        $array['body'] = $txt;

        header("Content-Type: application/json");
        echo json_encode($array);
        exit;
    }

    public function upload(Request $request)
    {
        $array = ['error' => ''];

        $loggedUser = Auth::user();

        $request->validate([
            'photo' => 'required|image|mimes:jpeg,jpg,png'
        ]);

        $ext = $request->photo->extension();

        $imageName = md5(time() . rand(0, 9999)) . '.' . $ext;

        $request->photo->move(public_path('media/uploads'), $imageName);

        $post = new Post;
        $post->id_user = $loggedUser->id;
        $post->type = 'photo';
        $post->body = $imageName;
        $post->save();

        header("Content-Type: application/json");
        echo json_encode($array);
        exit;
    }
}

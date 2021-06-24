<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostComment;
use App\User;
use App\UserRelation;
use App\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function new() {

        $loggedUser = Auth::user();

        
        $body = filter_input(INPUT_POST, 'body');

        if($body) {
            PostHandler::addPost(
                $this->loggedUser->id,
                'text',
                $body
            );
        }

        $t = new Post;
        $t->id_user = '';
        $t->id_user = '';
        $t->body = '';
        $t->save();


        Post::insert([
            'id_user' => $idUser,
            'type' => $type,
            'body' => $body
        ])->execute();


        $this->redirect('/');
    }

    public function delete($atts = []) {
        if(!empty($atts['id'])) {
            $idPost = $atts['id'];

            PostHandler::delete(
                $idPost,
                $this->loggedUser->id
            );
        }

        $this->redirect('/');
    }
}

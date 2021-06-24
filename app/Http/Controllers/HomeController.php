<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostComment;
use App\User;
use App\UserRelation;
use App\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $loggedUser = Auth::user();

        // 1. pegar lista de usuários que EU sigo.
        $userList = UserRelation::where('user_from', $loggedUser->id)->get();
        $users = [];
        foreach ($userList as $userItem) {
            $users[] = $userItem['user_to'];
        }
        $users[] = $loggedUser->id;

        // 2. pegar os posts dessa galera ordenado pela data.
        $postList = Post::whereIn('id_user', $users)
            ->orderBy('created_at', 'desc')
            ->get();

        // 3. transformar o resultado em objetos dos models
        $posts = [];
        foreach ($postList as $postItem) {
            $newPost = new Post();
            $newPost->id = $postItem['id'];
            $newPost->type = $postItem['type'];
            $newPost->created_at = $postItem['created_at'];
            $newPost->body = $postItem['body'];
            $newPost->mine = false;

            if ($postItem['id_user'] == $loggedUser->id) {
                $newPost->mine = true;
            }

            // 4. preencher as informações adicionais no post
            $newUser = User::where('id', $postItem['id_user'])->first();
            $newPost->user = new User();
            $newPost->user->id = $newUser['id'];
            $newPost->user->name = $newUser['name'];
            $newPost->user->avatar = $newUser['avatar'];

            // TODO: 4.1 preencher informações de LIKE
            $likes = PostLike::where('id_post', $postItem['id'])->get();

            $newPost->likeCount = count($likes);
            $newPost->liked = PostLike::where('id_post', $postItem['id'])
                ->where('id_user', $loggedUser->id)
                ->count();

            // TODO: 4.2 preencher informações de COMMENTS
            $newPost->comments = PostComment::where('id_post', $postItem['id'])->get();
            foreach ($newPost->comments as $key => $comment) {
                $newPost->comments[$key]['user'] = User::where('id', $comment['id_user'])->first();
            }

            $posts[] = $newPost;
        }

        $feed = ['posts' => $posts];

        return view('home', [
            'loggedUser' => $loggedUser,
            'feed' => $feed,
        ]);
    }
}

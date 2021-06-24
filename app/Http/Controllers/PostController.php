<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function new(Request $request)
    {
        $loggedUser = Auth::user();

        $body = $request->input('body');

        $t = new Post;
        $t->id_user = $loggedUser->id;
        $t->type = 'text';
        $t->body = $body;
        $t->save();

        return redirect()->route('index');
    }

    public function delete($id)
    {
        if (!empty($id)) {
            Post::where('id', $id)->delete();
        }

        return redirect()->route('index');
    }
}

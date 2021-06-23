<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Handlers\PostHandler;
use App\Http\Handlers\UserHandler;

class HomeController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->loggedUser = UserHandler::checkLogin();
        if ($this->loggedUser === false) {
            return redirect()->route('login.signin');
        }
    }

    public function index()
    {
        print_r($this->loggedUser);
        echo "home";
        exit;

        return view('home', ['loggedUser' => $this->loggedUser]);
    }
}

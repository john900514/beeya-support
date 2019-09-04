<?php

namespace App\Http\Controllers;

use App\GameSessions;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index(GameSessions $sesh)
    {
        $args = [
            'visit_token' => csrf_token(),
            'game_token' => bcrypt(csrf_token().strtotime('now')),
            'ip' => $this->request->ip()
        ];

        // create a session in the DB
        $new_game = new GameSessions ($args);
        $new_game->save();

        return view('home', $args);
    }
}

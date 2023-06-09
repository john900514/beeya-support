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

        $args['game_rounds'] = env('GAME_ROUNDS', 3);
        $args['reqd_clicks'] = env('REQD_CLICKS', 5);
        $args['search_mode'] = env('SEARCH_MODE', 'Default');

        return view('home', $args);
    }
}

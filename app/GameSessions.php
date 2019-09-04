<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameSessions extends Model
{
    protected $fillable = ['visit_token', 'game_token','ip'];
}

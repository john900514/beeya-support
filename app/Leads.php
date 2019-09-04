<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    protected $fillable = ['game_id', 'fname', 'lname', 'email', 'mobile'];
}

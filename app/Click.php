<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    protected $fillable = ['sessionId', 'position', 'clickNo', 'sourceJobId', 'jobName', 'company', 'jobTitle', 'agency','round'];
}

<?php

namespace App;

use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Places extends Model
{
    use UuidModel, SoftDeletes;

    protected $fillable = ['name', 'lat', 'long', 'misc'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    //
    protected $table = 'food';

    protected $guarded = ['created_at', 'updated_at'];
}

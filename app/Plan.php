<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $table = 'plan';

    protected $guarded = ['created_at', 'updated_at'];

    public function details()
    {
        return $this->hasMany('App\PlanDetail');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanDetail extends Model
{
    //
    protected $table = 'plan_detail';

    protected $guarded = ['created_at', 'updated_at'];

    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }
}

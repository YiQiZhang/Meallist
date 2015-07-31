<?php

namespace App\Http\Controllers\MealList;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plan;
use App\PlanDetail;
use App\MealList;
use App\Food;

class MealListController extends Controller
{

    public function index($plan_id = 0)
    {
        $param = get_constant();
        $param['plan_list'] = Plan::all();

        if (!empty($plan_id)) {
            $param['plan_id'] = $plan_id;
        } elseif(count($param['plan_list']) > 0) {
            $plan_id = $param['plan_list'][0]->id;
            $param['plan_id'] = $plan_id;
        } else {
            $param['plan_id'] = 0;
        }

        if($param['plan_id'] > 0) {
            $param['food_list_data'] = Food::orderBy('type')->get();

            return view('meallist.makeMealList')->with('param', $param);
        } else {
            return '请先创建一个计划';
        }
    }

    private function apiReturn($data)
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}

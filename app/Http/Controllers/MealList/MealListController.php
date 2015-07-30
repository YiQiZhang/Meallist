<?php

namespace App\Http\Controllers\MealList;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plan;
use App\PlanDetail;
use App\MealList;

class MealListController extends Controller
{
    public function index()
    {
        return view('meallist.makePlan')->with('param', [
            'nutrition_type' => Meallist::$nutrition_type,
            'meal_type' => MealList::$meal_type,
            'plan_list' => Plan::all()
        ]);
    }

    public function getPlanDetail(Request $request)
    {
        $plan_id = $request->input('plan_id');
        if ($plan_id > 0) {
            $plan = Plan::where('id', $plan_id)->first();
            $return = [
                'plan' => $plan->toArray(),
                'plan_detail' => $plan->details
            ];
        } else {
            $plan = [
                'id' => 0,
                'name' => '',
                'from_date' => '',
                'to_date' => ''
            ];
            foreach(Meallist::$nutrition_type as $nutrition_type) {
                $plan[$nutrition_type] = 0;
            }
            $plan_detail = [];
            foreach(MealList::$meal_type as $meal_type => $meal_id) {
                $object = new \stdClass();
                $object->type = $meal_id;
                foreach(Meallist::$nutrition_type as $nutrition_type) {
                    $object->$nutrition_type = 0;
                }
                $plan_detail[] = $object;
            }
            $return = [
                'plan' => $plan,
                'plan_detail' => $plan_detail
            ];
        }

        return $this->apiReturn($return);
    }

    public function planCreate(Request $request)
    {
        $plan_id = $request->input('plan_id');
        $plan_detail_data = $this->formatPlanDetailData($request);
        $plan_data = $this->formatPlanData($request, $this->sumNutrition($plan_detail_data));

        if( $plan_id > 0) {
            Plan::where('id', $plan_id)->update($plan_data);
            PlanDetail::where('plan_id', $plan_id)->delete();

        } else {
            $plan = Plan::create($plan_data);

            if ($plan->id) {
                $plan_id = $plan->id;
            }
        }

        if (count($plan_detail_data) > 0) {
            foreach($plan_detail_data as $plan_detail) {
                $plan_detail['plan_id'] = $plan_id;
                PlanDetail::create($plan_detail);
            }
        }


        return redirect()->route('makeMealList', ['id' => $plan_id]);
    }

    private function formatPlanData($request, $data = [])
    {
        $return = [
            'name' => $request->input('from_date').'~'.$request->input('to_date'),
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date')
        ];

        if( count($data) > 0) {
            foreach($data as $k=>$v) {
                $return[$k] = $v;
            }
        }

        return $return;
    }

    private function formatPlanDetailData($request)
    {
        $return = [];
        foreach(MealList::$meal_type as $meal_type=>$meal_id) {
            $return[$meal_type]['type'] = $meal_id;
            foreach(Meallist::$nutrition_type as $nutrition) {
                $return[$meal_type][$nutrition] = $request->input(meal_nutrition_input_name($meal_type, $nutrition));
                if(empty($return[$meal_type][$nutrition])) {
                    $return[$meal_type][$nutrition] = '0';
                }
            }
        }

        return $return;
    }

    private function sumNutrition($palnDetailData)
    {
        foreach(Meallist::$nutrition_type as $nutrition){
            $return[$nutrition] = 0;
        }

        foreach($palnDetailData as $meal_type => $plan_detail) {
            foreach(Meallist::$nutrition_type as $nutrition) {
                $return[$nutrition] += $plan_detail[$nutrition];
            }
        }

        return $return;
    }

    public function makeMealList()
    {
        return view('meallist.makeMealList')->with('param', [
            'nutrition_type' => Meallist::$nutrition_type,
            'meal_type' => MealList::$meal_type
        ]);
    }

    private function apiReturn($data)
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}

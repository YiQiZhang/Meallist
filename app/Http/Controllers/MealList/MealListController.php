<?php

namespace App\Http\Controllers\MealList;

use App\MealList;
use App\Http\Controllers\Controller;

class MealListController extends Controller
{
    public function index()
    {
        return view('meallist.makePlan')->with('param', [
            'nutrition_type' => Meallist::$nutrition_type,
            'meal_type' => MealList::$meal_type
        ]);
    }

    public function makeMealList()
    {
        return view('meallist.makeMealList')->with('param', [
            'nutrition_type' => Meallist::$nutrition_type,
            'meal_type' => MealList::$meal_type
        ]);
    }
}

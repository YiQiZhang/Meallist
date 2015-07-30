<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealList extends Model
{
    // 营养类型
    public static $nutrition_type = [
        'energy', 'protein', 'fat', 'carbohydrate'
    ];

    // 营养单位
    public static $nutrition_unit = [
        'energy' => '千卡',
        'protein' => '克',
        'fat' => '克',
        'carbohydrate' => '克'
    ];

    // 餐类型
    public static $meal_type = [
        'breakfast' => 1,
        'morningTea' => 2,
        'lunch' => 3,
        'afternoonTea' => 4,
        'dinner' => 5,
        'nightSnack' => 6
    ];

    // 食物类型
    public static $food_type = [
        'grain' => 1,
        'vegetable' => 2,
        'fruit' => 3,
        'meat' => 4,
        'beanMilk' => 5,
        'oil' => 6
    ];
}

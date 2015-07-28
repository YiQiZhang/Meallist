<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealList extends Model
{
    // 营养类型
    public static $nutrition_type = [
        'energy', 'protein', 'fat', 'carbohydrate'
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
}

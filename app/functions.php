<?php
/**
 * Created by PhpStorm.
 * User: zhangyiqi
 * Date: 7/28/15
 * Time: 2:54 PM
 */

use App\MealList;

if (!function_exists('tpl_language')) {
    /**
     * Return naked domain without prefix
     *
     * @param $envKeys
     * @param $host
     *
     * @return mixed
     */
    function tpl_language($key)
    {
        $arr = [
            'energy' => '热量',
            'protein' => '蛋白质',
            'fat' => '脂肪',
            'carbohydrate' => '碳水化合物',
            'breakfast' => '早餐',
            'morningTea' => '上午茶',
            'lunch' => '午餐',
            'afternoonTea' => '下午茶',
            'dinner' => '晚餐',
            'nightSnack' => '宵夜',
            'extraMeal' => '加餐',
            'grain' => '谷物',
            'vegetable' => '蔬菜',
            'fruit' => '水果',
            'meat' => '肉类',
            'beanMilk' => '蛋奶',
            'oil' => '油脂'
        ];
        return isset($arr[$key]) ? $arr[$key] : 'unknown';
    }
}

if(!function_exists('get_constant')) {
    function get_constant()
    {
        return [
            'nutrition_unit' => MealList::$nutrition_unit,
            'nutrition_type' => Meallist::$nutrition_type,
            'meal_type' => MealList::$meal_type,
            'food_type' => MealList::$food_type
        ];
    }
}


if (!function_exists('meal_nutrition_input_name')) {
    function meal_nutrition_input_name($meal_name, $nutrition)
    {
        return $meal_name.'_'.$nutrition;
    }
}


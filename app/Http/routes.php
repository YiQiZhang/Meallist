<?php


Route::group(['namespace' => 'MealList'], function(){
    Route::get('/', 'MealListController@index');
});
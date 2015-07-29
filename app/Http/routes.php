<?php


Route::group(['namespace' => 'MealList'], function(){
    Route::get('/', 'MealListController@index');

    Route::get('/makeMealList', 'MealListController@makeMealList');
});
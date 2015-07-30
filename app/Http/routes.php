<?php

Route::group(['prefix' => 'api', 'namespace' => 'MealList'], function(){
    Route::get('/getPlanDetail', 'MealListController@getPlanDetail');

});

Route::group(['namespace' => 'MealList'], function(){
    Route::get('/', 'MealListController@index');
    Route::post('/makePlanAction', 'MealListController@planCreate');

    Route::get('/makeMealList/{id?}', ['as' => 'makeMealList', 'uses' => 'MealListController@makeMealList']);
});
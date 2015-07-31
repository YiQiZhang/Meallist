<?php

Route::group(['prefix' => 'api', 'namespace' => 'MealList'], function(){
    Route::get('/getPlanDetail', 'PlanController@getPlanDetail');

});

Route::group(['namespace' => 'MealList'], function(){
    Route::get('/', 'PlanController@index');
    Route::post('/makePlanAction', 'PlanController@planCreate');

    Route::get('/makeMealList/{id?}', ['as' => 'makeMealList', 'uses' => 'MealListController@index']);
});
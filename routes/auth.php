<?php

Route::get('cube_summation/list', [
    'as' => 'cube_summation.list',
    'uses' => 'CubeSummation\ListController@executeAction',
]);

Route::get('cube_summation/details/{test}', [
    'as' => 'cube_summation.details',
    'uses' => 'CubeSummation\DetailsController@executeAction',
]);

Route::get('cube_summation/generate_plain', [
    'as' => 'cube_summation.generate_plain',
    'uses' => 'CubeSummation\GeneratePlainController@generateAction',
]);

Route::post('cube_summation/generate_plain', [
    'as' => 'cube_summation.generate_plain.execute',
    'uses' => 'CubeSummation\GeneratePlainController@executeAction',
]);

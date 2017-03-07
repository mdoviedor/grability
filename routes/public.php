<?php

/*
  |--------------------------------------------------------------------------
  | Public Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register public routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return redirect()->route('cube_summation.public_generator');
});

Route::get('cube_summation/public_generator', [
    'as' => 'cube_summation.public_generator',
    'uses' => 'CubeSummation\PublicGeneratorController@generateAction',
]);

Route::post('cube_summation/public_generator', [
    'as' => 'cube_summation.public_generator.execute',
    'uses' => 'CubeSummation\PublicGeneratorController@executeAction',
]);

Auth::routes();

Route::get('/home', 'HomeController@index');

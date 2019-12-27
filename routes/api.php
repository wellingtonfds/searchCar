<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('cars/search','CarController@search')->name('cars.search');
Route::resource('cars','CarController');

Route::get('seed',function (\App\Services\CrawlerCarBrands $carBrands){
    $carBrands->crawler();
    return response('wait for jobs thanks');
})->name('seed');

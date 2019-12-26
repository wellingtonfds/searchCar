<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $crawler = \Spatie\Crawler\Crawler::create()
        ->addCrawlObserver(new \App\Observers\GetCarObserver())
        ->setMaximumDepth(1)
        ->startCrawling('https://seminovos.com.br/carro/chevrolet');
    $crawler;
});

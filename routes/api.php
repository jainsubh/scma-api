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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(array('prefix' => 'v1', 'middleware' => []), function () {
    Route::put('categories/changeCategory', 'CategoryController@changeCategory');
    Route::resource('categories','CategoryController', ['except' => ['edit', 'create', 'show']]);
    Route::resource('globals', 'GlobalController', ['except' => ['edit', 'create', 'show', 'update']]);
    Route::put('globals/{keyword}', 'GlobalController@update');
    Route::resource('events','EventController', ['except' => ['edit', 'create', 'show']]);
    Route::resource('sites','SiteController', ['except' => ['edit', 'create', 'show']]);
    Route::get('crawl_logs', 'CrawlController@index');
    Route::post('crawl_job','EventController@crawl_job');
    Route::get('crawl_status/{id}','EventController@crawl_status');
    Route::post('crawl_multiple_status','EventController@crawl_multiple_status');
});
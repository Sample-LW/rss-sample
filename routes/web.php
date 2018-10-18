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

Route::get('news-feed',array('as'=>'news-feed','uses'=>'NewsFeedController@newsFeed'));
Route::get('news-feed/ajax/{id}',array('as'=>'news-feed.ajax','uses'=>'NewsFeedController@newsFeedAjax'));

Route::get('/feed', 'FeedController@index');
Route::get('feed/{feed_id?}', 'FeedController@show');
Route::post('feed', 'FeedController@store');
Route::put('feed/{feed_id}', 'FeedController@update');
Route::delete('feed/{feed_id}', 'FeedController@destroy');



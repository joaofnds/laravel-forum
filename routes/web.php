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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'ForumsController@index')
    ->name('home');

Route::get('{provider}/auth', 'SocialController@auth')
    ->name('social.auth');

Route::get('{provider}/redirect', 'SocialController@auth_callback')
    ->name('social.callback');

Route::group(['middleware' => 'auth'], function() {

    Route::resource('channels', 'ChannelsController');

    Route::resource('discussions', 'DiscussionsController');

    Route::post('/discussions/{id}/reply', 'DiscussionsController@reply')
        ->name('discussions.reply.store');

    Route::get('/discussions/{id}/delete', 'DiscussionsController@delete')
        ->name('discussions.reply.delete');
});

Route::get('/test', function() {
    $values = App\User::query()->pluck('id')->all();
    $key = array($values);
    return $values[$key];
});
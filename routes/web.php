<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RootController;
use App\Http\Controllers\FullCalenderController;

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
Route::get('root', [RootController::class, 'index'])->name('auth.rootindex');
Route::post('root', [RootController::class, 'check'])->name('auth.check');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    //user_management_routes
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['destroy']])->middleware('admin');
    Route::get('user/destroy/{user}', 'App\Http\Controllers\UserController@destroy')->name('user.destroy')->middleware('admin');;
    Route::put('user/password/{user}', ['as' => 'user.update_password', 'uses' => 'App\Http\Controllers\UserController@update_password']);

    //profile_admin_routes
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::put('profile/script', ['as' => 'profile.script_appel', 'uses' => 'App\Http\Controllers\ProfileController@update_script']);

    //pros_table_routes
    Route::resource('prospect', 'App\Http\Controllers\ProspectController', ['except' => 'destroy']);
    Route::get('prospect/destroy/{prospect}', 'App\Http\Controllers\ProspectController@destroy')->name('prospect.destroy')->middleware('admin');
    Route::put('prospect/update/{prospect}', 'App\Http\Controllers\ProspectController@update_form')->name('prospect.update_form');
    Route::post('prospect/import', 'App\Http\Controllers\ProspectController@import')->name('prospect.import');

    //Chart routes
    Route::get('chart/comm/{id}',[[HomeController::class, 'chart']])->name('chart.comm')->middleware('admin');

    // Calendar routes
    Route::get('calendar/index', [FullCalenderController::class, 'index'])->name('calender');
    Route::post('calendar', [FullCalenderController::class, 'store'])->name('calendar.store');
    Route::patch('calendar/update/{id}', [FullCalenderController::class, 'update'])->name('calendar.update');
    Route::delete('calendar/destroy/{id}', [FullCalenderController::class, 'destroy'])->name('calendar.destroy');
});

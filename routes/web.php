<?php

use Illuminate\Support\Facades\Route;

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
})->middleware('guest:staff,students');

Route::post('/login', 'App\Http\Controllers\AuthenticationController@login')->middleware('guest:staff,students');
Route::get('/logout', 'App\Http\Controllers\AuthenticationController@logout')->middleware('auth:staff,students');


Route::get('/history', 'App\Http\Controllers\HistoryController@show')->middleware('auth:staff,students');
Route::get('/pending', 'App\Http\Controllers\PendingController@show')->middleware('auth:staff');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@show')->middleware('auth:students');

Route::post('/leave/{leave}/approve', 'App\Http\Controllers\LeaveController@approve')->middleware('auth:staff');

Route::post('/leave/{leave}/reject', 'App\Http\Controllers\LeaveController@reject')->middleware('auth:staff');

Route::post('/leave/{leave}/meetStudent', 'App\Http\Controllers\LeaveController@meetStudent')->middleware('auth:staff');

Route::get('/leave/{leave}/cancel', 'App\Http\Controllers\LeaveController@cancel')->middleware('auth');

Route::get('/leave/{leave}/supportingDocuments/{supportingDocument}', 'App\Http\Controllers\LeaveController@getSupportingDocument')->middleware('auth:staff,students');

Route::get('/leave/{leave}', 'App\Http\Controllers\LeaveController@show')->middleware('auth:staff,students');

Route::get('/ApplicationForm', 'App\Http\Controllers\LeaveApplicationFormController@index')->middleware('auth:students');

Route::get('/ApplicationConfirmation/confirm', 'App\Http\Controllers\LeaveApplicationConfirmationController@storeDB')->name('ApplicationConfirmation/confirm')->middleware('auth:students');

Route::get('/ApplicationConfirmation/download/{filename}', 'App\Http\Controllers\LeaveApplicationConfirmationController@downloadDoc')->middleware('auth:students');

Route::post('/ApplicationConfirmation', 'App\Http\Controllers\LeaveApplicationConfirmationController@passInput')->name('ApplicationConfirmation')->middleware('auth:students');

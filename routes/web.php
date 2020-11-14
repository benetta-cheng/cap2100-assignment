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

Route::get('/layout', function () {
    return view('layout.layout');
});
Route::get('/history', 'App\Http\Controllers\HistoryController@show');
Route::get('/pending', 'App\Http\Controllers\PendingController@show');
Route::get('/dashboard', function () {
    $dashboardTestData = [
        "newUpdates" => [
            ["update" => "Mr Tang Yang Tze has approved your leave", "leaveId" => "SL12345"],
            ["update" => "Ms Ng Ruoh Ling has approved your leave", "leaveId" => "SL12345"],
            ["update" => "Ms Fui Chie Shee has approved your leave", "leaveId" => "SL12345"],
            ["update" => "Ms Lusiana Syaiful has approved your leave", "leaveId" => " SL12344"],
        ],
        "approvalStatuses" => [
            ["course" => "IBM2104", "leaveId" => "SL12345", "status" => "APPROVED"],
            ["course" => "IBM2105", "leaveId" => "SL12345", "status" => "REJECTED"],
            ["course" => "CAP2100", "leaveId" => "SL12345", "status" => "PENDING"],
            ["course" => "IBM2104", "leaveId" => "SL12345", "status" => "REJECTED"]
        ]
    ];
    return view('dashboard', $dashboardTestData);
});

Route::post('/leave/{leave}/approve', 'App\Http\Controllers\LeaveController@approve')->middleware('auth:staff');

Route::post('/leave/{leave}/reject', 'App\Http\Controllers\LeaveController@reject')->middleware('auth:staff');

Route::post('/leave/{leave}/meetStudent', 'App\Http\Controllers\LeaveController@meetStudent')->middleware('auth:staff');

Route::post('/leave/{leave}/cancel', 'App\Http\Controllers\LeaveController@cancel')->middleware('auth');

Route::get('/leave/{leave}/supportingDocuments/{supportingDocument}', 'App\Http\Controllers\LeaveController@getSupportingDocument')->middleware('auth:staff,students');

Route::get('/leave/{leave}', 'App\Http\Controllers\LeaveController@show')->middleware('auth:staff,students');

//Get Application Form view
Route::get('/ApplicationForm', 'App\Http\Controllers\LeaveApplicationFormController@index'); 

//Store application info into database and redirect to History page
Route::get('/ApplicationConfirmation/confirm','App\Http\Controllers\LeaveApplicationConfirmationController@storeDB')->name('ApplicationConfirmation/confirm');

//Enable download and clickable link for file when displaying on confirmation page
Route::get('/ApplicationConfirmation/download/{filename}', 'App\Http\Controllers\LeaveApplicationConfirmationController@downloadDoc');

//Get Application Confirmation view, inputs from Application from form is passed here, input storing in session and validation for affected classes is done here
Route::post('/ApplicationConfirmation','App\Http\Controllers\LeaveApplicationConfirmationController@passInput')->name('ApplicationConfirmation');

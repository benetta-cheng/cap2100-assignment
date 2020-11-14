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

Route::get('/history', function () {
    $historyTestData = [
        "userRole" => "Student",
        "leaves" => [
            ["leaveId" => "SL12345", "courseId" => "IBM2104", "student" => "Daniel Lee", "approvalStatus" => "APPROVED", "dateApplied" => "03/09/2020"],
            ["leaveId" => "SL12347", "courseId" => "IBM2104", "student" => "Katy Johnson*", "approvalStatus" => "REJECTED", "dateApplied" => "03/09/2020"],
            ["leaveId" => "SL12346", "courseId" => "IBM2104", "student" => "Vinita Mageswaran", "approvalStatus" => "APPROVED", "dateApplied" => "03/09/2020"],
            ["leaveId" => "SL12365", "courseId" => "IBM2104", "student" => "Anjay Keesha", "approvalStatus" => "PENDING", "dateApplied" => "03/09/2020"],
            ["leaveId" => "SL12405", "courseId" => "IBM2104", "student" => "Ilya Vladimir*", "approvalStatus" => "APPROVED", "dateApplied" => "03/09/2020"],
            ["leaveId" => "SL12415", "courseId" => "IBM2104", "student" => "Xiao Ming", "approvalStatus" => "APPROVED", "dateApplied" => "03/09/2020"]
        ],
        "pageData" => [
            "currentPage" => 1,
            "maxPage" => 5
        ]
    ];
    return view('history', $historyTestData);
});
Route::get('/pending', function () {
    $pendingTestData = [
        "leaves" => [
            ["leaveId" => "SL12345", "courseId" => "IBM2104", "student" => "Daniel Lee"],
            ["leaveId" => "SL12347", "courseId" => "IBM2104", "student" => "Katy Johnson*"],
            ["leaveId" => "SL12346", "courseId" => "IBM2104", "student" => "Vinita Mageswaran"],
            ["leaveId" => "SL12365", "courseId" => "IBM2104", "student" => "Anjay Keesha"],
            ["leaveId" => "SL12405", "courseId" => "IBM2104", "student" => "Ilya Vladimir*"],
            ["leaveId" => "SL12415", "courseId" => "IBM2104", "student" => "Xiao Ming"]
        ],
        "pageData" => [
            "currentPage" => 1,
            "maxPage" => 5
        ]
    ];
    return view('pending', $pendingTestData);
});

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@show');

Route::post('/leave/{leave}/approve', 'App\Http\Controllers\LeaveController@approve')->middleware('auth:staff');

Route::post('/leave/{leave}/reject', 'App\Http\Controllers\LeaveController@reject')->middleware('auth:staff');

Route::post('/leave/{leave}/meetStudent', 'App\Http\Controllers\LeaveController@meetStudent')->middleware('auth:staff');

Route::post('/leave/{leave}/cancel', 'App\Http\Controllers\LeaveController@cancel')->middleware('auth');

Route::get('/leave/{leave}/supportingDocuments/{supportingDocument}', 'App\Http\Controllers\LeaveController@getSupportingDocument')->middleware('auth:staff,students');

Route::get('/leave/{leave}', 'App\Http\Controllers\LeaveController@show')->middleware('auth:staff,students');

//Get Application Form view
Route::get('/ApplicationForm', 'App\Http\Controllers\LeaveApplicationFormController@index');

//Store application info into database and redirect to History page
Route::get('/ApplicationConfirmation/confirm', 'App\Http\Controllers\LeaveApplicationConfirmationController@storeDB')->name('ApplicationConfirmation/confirm');

//Enable download and clickable link for file when displaying on confirmation page
Route::get('/ApplicationConfirmation/download/{filename}', 'App\Http\Controllers\LeaveApplicationConfirmationController@downloadDoc');

//Get Application Confirmation view, inputs from Application from form is passed here, input storing in session and validation for affected classes is done here
Route::post('/ApplicationConfirmation', 'App\Http\Controllers\LeaveApplicationConfirmationController@passInput')->name('ApplicationConfirmation');

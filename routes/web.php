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
});
Route::get('/layout', function () {
    return view('layout.layout');
});
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
Route::get('/leave', function () {
    // This is just test data in the form of an array, the actual code will most likely return an object (Changes from array to object need to be made in leave.blade.php in that case)
    $leaveTestData = [
        "userRole" => "Lecturer", // Will probably be changed when proper authentication is setup
        "details" => [
            "leaveId" => "SL123456",
            "leaveType" => "Sick Leave",
            "leavePeriod" => "01/01/2020 08:00 - 05/01/2020 16:00",
            "leaveStatus" => "PENDING",
            "reason" => "Broken Arm because I fell off a hill while going mountain climbling with my friends during semester break",
            "supportingDocuments" => [
                ["name" => "MC(Broken arm).png", "link" => "#"],
                ["name" => "MC(Hospitalization).png", "link" => "#"]
            ],
            "affectedClasses" => [
                "IBM2104 INTRODUCTION TO WEB PROGRAMMING WITH PHP",
                "ICT2102 INTRODUCTION TO DATA STRUCTURE",
                "IBM2105 INTRODUCTION TO MOBILE APPS DEVELOPMENT"
            ],
            "studentName" => "John Doe",
            "studentMatricId" => "J19029540",
            "studentId" => "012345-67-8900",
            "session" => "August 2020",
            "contact" => "+60123456789",
            "address" => "Jalan Smtg 123, Taman 123, 47500, Selangor",
            "programme" => "Diploma In Information Technology"
        ],
        "approvalStatus" => [
            ["approver" => "TANG YANG TZE (IBM2104)", "status" => "APPROVED"],
            ["approver" => "NG RUOH LING (ICT2100)", "status" => "PENDING"],
            ["approver" => "FUI CHIE SHEE (IBM2104)", "status" => "REQUEST", "remarks" => "You have used the same reason that your arm broke more than three times."],
            ["approver" => "THANESH DORAISAMY (HOP)", "status" => "REJECTED", "remarks" => "Too many leaves! You have used the same reason that your arm broke more than three times."],
        ]
    ];
    return view('leave', $leaveTestData);
});


Route::get('/ApplicationForm', function () {
    return view('ApplicationForm');
});

Route::get('/ApplicationConfirmation', function () {

     // This is just test data in the form of an array, the actual code will most likely return an object (Changes from array to object need to be made in leave.blade.php in that case)
     $leaveTestData = [
        "userRole" => "Lecturer", // Will probably be changed when proper authentication is setup
        "details" => [
            "leaveId" => "SL123456",
            "leaveType" => "Sick Leave",
            "leavePeriod" => "01/01/2020 08:00 - 05/01/2020 16:00",
            "leaveStatus" => "PENDING",
            "reason" => "Broken Arm because I fell off a hill while going mountain climbling with my friends during semester break",
            "supportingDocuments" => [
                ["name" => "MC(Broken arm).png", "link" => "#"],
                ["name" => "MC(Hospitalization).png", "link" => "#"]
            ],
            "affectedClasses" => [
                "IBM2104 INTRODUCTION TO WEB PROGRAMMING WITH PHP",
                "ICT2102 INTRODUCTION TO DATA STRUCTURE",
                "IBM2105 INTRODUCTION TO MOBILE APPS DEVELOPMENT"
            ]
        ]
    ];
    return view('ApplicationConfirmation', $leaveTestData);
});

Route::get('/StudentHistory', function () {
    return view('StudentHistory');
});

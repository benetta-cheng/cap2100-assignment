<?php

namespace Tests\Unit;

use App\Enum\StudentType;
use App\Enum\UserType;
use App\Models\LeaveApplication;
use App\Models\Staff;
use App\Models\Student;
use Tests\TestCase;

class RouteAuthenticationTest extends TestCase
{
    /**
     * Test all routes against a guest user.
     *
     * @return void
     */
    public function testGuestTest()
    {
        $response = $this->get('/');
        $response->assertOk();

        $response = $this->get('/history');
        $response->assertRedirect('/');

        $response = $this->get('/pending');
        $response->assertRedirect('/');

        $response = $this->get('/dashboard');
        $response->assertRedirect('/');

        $response = $this->get('/ApplicationForm');
        $response->assertRedirect('/');

        $leaveApplications = LeaveApplication::all();

        foreach ($leaveApplications as $leave) {
            $response = $this->get('/leave/' . $leave->leave_id);
            $response->assertRedirect('/');

            $supportingDocuments = $leave->supportingDocuments;

            foreach ($supportingDocuments as $document) {
                $response = $this->get('/leave/' . $leave->leave_id . '/supportingDocuments/' . $document->id);
                $response->assertRedirect('/');
            }
        }
    }

    /**
     * Test all routes against all student user.
     *
     * @return void
     */
    public function testStudentTest()
    {
        $students = Student::all();

        foreach ($students as $student) {
            $this->actingAs($student);
            $response = $this->get('/');
            $response->assertRedirect('/dashboard');

            $response = $this->get('/history');
            $response->assertOk();

            $response = $this->get('/pending');
            $response->assertRedirect('/');

            $response = $this->get('/dashboard');
            $response->assertOk();

            $response = $this->get('/ApplicationForm');
            $response->assertOk();

            $leaveApplications = LeaveApplication::all();

            foreach ($leaveApplications as $leave) {

                $permitted = false;

                if ($leave->student->is($student)) {
                    $permitted = true;
                }

                $response = $this->get('/leave/' . $leave->leave_id);
                if ($permitted) {
                    $response->assertOk();
                } else {
                    $response->assertForbidden();
                }

                $supportingDocuments = $leave->supportingDocuments;

                foreach ($supportingDocuments as $document) {
                    $response = $this->get('/leave/' . $leave->leave_id . '/supportingDocuments/' . $document->id);
                    if ($permitted) {
                        $response->assertOk();
                    } else {
                        $response->assertForbidden();
                    }
                }
            }
        }
    }

    /**
     * Test all routes against all staff user.
     *
     * @return void
     */
    public function testStaffTest()
    {
        $staffs = Staff::all();

        foreach ($staffs as $staff) {
            $this->actingAs($staff, 'staff');
            $response = $this->get('/');
            $response->assertRedirect('/pending');

            $response = $this->actingAs($staff)->get('/history');
            $response->assertOk();

            $response = $this->get('/pending');
            $response->assertOk();

            $response = $this->get('/dashboard');
            $response->assertRedirect('/');

            $response = $this->get('/ApplicationForm');
            $response->assertRedirect('/');

            $leaveApplications = LeaveApplication::all();

            foreach ($leaveApplications as $leave) {

                $permitted = false;

                if ($staff->staff_type === UserType::IO && $leave->student->student_type === StudentType::INTERNATIONAL) {
                    $permitted = true;
                } else if ($staff->staff_type === UserType::HOP && $leave->student->studentProgramme->headOfProgramme->is($staff)) {
                    $permitted = true;
                } else {
                    foreach ($leave->leaveActions->where('staff_authority', UserType::LECTURER) as $action) {
                        if ($action->session->section->staff->is($staff)) {
                            $permitted = true;
                        }
                    }
                }

                $response = $this->get('/leave/' . $leave->leave_id);
                if ($permitted) {
                    $response->assertOk();
                } else {
                    $response->assertForbidden();
                }

                $supportingDocuments = $leave->supportingDocuments;

                foreach ($supportingDocuments as $document) {
                    $response = $this->get('/leave/' . $leave->leave_id . '/supportingDocuments/' . $document->id);
                    if ($permitted) {
                        $response->assertOk();
                    } else {
                        $response->assertForbidden();
                    }
                }
            }
        }
    }
}

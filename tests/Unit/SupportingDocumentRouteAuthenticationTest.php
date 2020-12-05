<?php

namespace Tests\Unit;

use App\Enum\StudentType;
use App\Enum\UserType;
use App\Models\LeaveApplication;
use App\Models\Staff;
use App\Models\Student;
use Tests\TestCase;

class SupportingDocumentRouteAuthenticationTest extends TestCase
{
    /**
     * Test supporting document route against a guest user.
     *
     * @return void
     */
    public function testGuestTest()
    {
        $leaveApplications = LeaveApplication::all();

        foreach ($leaveApplications as $leave) {

            $supportingDocuments = $leave->supportingDocuments;

            foreach ($supportingDocuments as $document) {
                $response = $this->get('/leave/' . $leave->leave_id . '/supportingDocuments/' . $document->id);
                $response->assertRedirect('/');
            }
        }
    }

    /**
     * Test supporting document route against all student user.
     *
     * @return void
     */
    public function testStudentTest()
    {
        $students = Student::all();

        foreach ($students as $student) {
            $this->actingAs($student);

            $leaveApplications = LeaveApplication::all();

            foreach ($leaveApplications as $leave) {

                $permitted = false;

                if ($leave->student->is($student)) {
                    $permitted = true;
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
     * Test supporting document route against all staff user.
     *
     * @return void
     */
    public function testStaffTest()
    {
        $staffs = Staff::all();

        foreach ($staffs as $staff) {
            $this->actingAs($staff, 'staff');

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

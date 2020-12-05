<?php

namespace Tests\Unit;

use App\Models\Staff;
use App\Models\Student;
use Tests\TestCase;

class ApplicationFormRouteAuthenticationTest extends TestCase
{
    /**
     * Test application form route against a guest user.
     *
     * @return void
     */
    public function testGuestTest()
    {
        $response = $this->get('/ApplicationForm');
        $response->assertRedirect('/');
    }

    /**
     * Test application form route against all student user.
     *
     * @return void
     */
    public function testStudentTest()
    {
        $students = Student::all();

        foreach ($students as $student) {
            $this->actingAs($student);
            $response = $this->get('/ApplicationForm');
            $response->assertOk();
        }
    }

    /**
     * Test application form route against all staff user.
     *
     * @return void
     */
    public function testStaffTest()
    {
        $staffs = Staff::all();

        foreach ($staffs as $staff) {
            $this->actingAs($staff, 'staff');
            $response = $this->get('/ApplicationForm');
            $response->assertRedirect('/');
        }
    }
}

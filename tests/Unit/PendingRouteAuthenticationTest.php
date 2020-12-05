<?php

namespace Tests\Unit;

use App\Models\Staff;
use App\Models\Student;
use Tests\TestCase;

class PendingRouteAuthenticationTest extends TestCase
{
    /**
     * Test pending route against a guest user.
     *
     * @return void
     */
    public function testGuestTest()
    {
        $response = $this->get('/pending');
        $response->assertRedirect('/');
    }

    /**
     * Test pending route against all student user.
     *
     * @return void
     */
    public function testStudentTest()
    {
        $students = Student::all();

        foreach ($students as $student) {
            $this->actingAs($student);
            $response = $this->get('/pending');
            $response->assertRedirect('/');
        }
    }

    /**
     * Test pending route against all staff user.
     *
     * @return void
     */
    public function testStaffTest()
    {
        $staffs = Staff::all();

        foreach ($staffs as $staff) {
            $this->actingAs($staff, 'staff');
            $response = $this->get('/pending');
            $response->assertOk();
        }
    }
}

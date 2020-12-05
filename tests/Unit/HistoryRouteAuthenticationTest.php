<?php

namespace Tests\Unit;

use App\Models\Staff;
use App\Models\Student;
use Tests\TestCase;

class HistoryRouteAuthenticationTest extends TestCase
{
    /**
     * Test history route against a guest user.
     *
     * @return void
     */
    public function testGuestTest()
    {
        $response = $this->get('/history');
        $response->assertRedirect('/');
    }

    /**
     * Test history route against all student user.
     *
     * @return void
     */
    public function testStudentTest()
    {
        $students = Student::all();

        foreach ($students as $student) {
            $this->actingAs($student);
            $response = $this->get('/history');
            $response->assertOk();
        }
    }

    /**
     * Test history route against all staff user.
     *
     * @return void
     */
    public function testStaffTest()
    {
        $staffs = Staff::all();

        foreach ($staffs as $staff) {
            $this->actingAs($staff, 'staff');
            $response = $this->get('/history');
            $response->assertOk();
        }
    }
}

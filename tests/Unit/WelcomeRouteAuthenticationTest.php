<?php

namespace Tests\Unit;

use App\Models\Staff;
use App\Models\Student;
use Tests\TestCase;

class WelcomeRouteAuthenticationTest extends TestCase
{
    /**
     * Test welcome route against a guest user.
     *
     * @return void
     */
    public function testGuestTest()
    {
        $response = $this->get('/');
        $response->assertOk();
    }

    /**
     * Test welcome route against all student user.
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
        }
    }

    /**
     * Test welcome route against all staff user.
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
        }
    }
}

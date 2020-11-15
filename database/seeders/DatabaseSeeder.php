<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrolment;
use App\Models\Programme;
use App\Models\Section;
use App\Models\Session;
use App\Models\Staff;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('student')->truncate();
        DB::table('leave_application')->truncate();
        DB::table('staff')->truncate();
        DB::table('programme')->truncate();
        DB::table('course')->truncate();
        DB::table('section')->truncate();
        DB::table('session')->truncate();
        DB::table('leave_action')->truncate();
        DB::table('supporting_document')->truncate();
        DB::table('enrolment')->truncate();

        Schema::enableForeignKeyConstraints();

        Staff::factory()->times(7)->create();
        Staff::factory()->times(2)->hop()->create();
        Staff::factory()->times(1)->io()->create();

        Programme::factory()->times(4)->create();

        Course::factory()->times(20)->has(Section::factory()->count(mt_rand(1, 3))->has(Session::factory()->count(mt_rand(1, 2)), 'session'), 'section')->create();

        $localStudents = Student::factory()->times(6)->create();
        $internationalStudents = Student::factory()->times(6)->international()->create();

        foreach ($localStudents as $student) {
            for ($i = 0; $i < 6; $i++) {
                Enrolment::factory()->supplyStudentId($student->student_id)->create();
            }
        }

        foreach ($internationalStudents as $student) {
            for ($i = 0; $i < 6; $i++) {
                Enrolment::factory()->supplyStudentId($student->student_id)->create();
            }
        }
    }
}

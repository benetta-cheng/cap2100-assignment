<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrolment;
use App\Models\Programme;
use App\Models\Section;
use App\Models\Session;
use App\Models\Staff;
use App\Models\Student;
use DB;
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

        Course::factory()->times(10)->create();

        Enrolment::factory()->times(10)->create();

        Programme::factory()->times(10)->create();

        Section::factory()->times(10)->create();

        Student::factory()->times(5)->create();
        Student::factory()->times(5)->international()->create();

        Staff::factory()->times(7)->create();
        Staff::factory()->times(2)->hop()->create();
        Staff::factory()->times(1)->io()->create();

        Session::factory()->times(10)->create();

        Schema::enableForeignKeyConstraints();
    }
}

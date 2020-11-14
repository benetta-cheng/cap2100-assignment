<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Schema;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
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

        DB::table('student')->insert([
            'student_id' => 'J12345678',
            'ic_num' => '012345-67-8910',
            'name' => 'Testing Student Name',
            'contact_num' => '012-3456789',
            'address' => 'No 32, Jalan Gembira 42/89, Taman Bahagia, 40400 Shah Alam, Selangor',
            'academic_session' => 'AUGUST 2020',
            'programme' => 'P0001',
            'password' => Hash::make('test'),
            'student_type' => 'international'
        ]);

        DB::table('student')->insert([
            'student_id' => 'J00000000',
            'ic_num' => '012345-67-8910',
            'name' => 'Testing Student Name 2',
            'contact_num' => '012-3456789',
            'address' => 'No 32, Jalan Gembira 42/89, Taman Bahagia, 40400 Shah Alam, Selangor',
            'academic_session' => 'AUGUST 2020',
            'programme' => 'P0001',
            'password' => Hash::make('test'),
            'student_type' => 'local'
        ]);

        DB::table('leave_application')->insert([
            'leave_id' => 'L123456',
            'leave_type' => 'Sick Leave',
            'student_id' => 'J12345678',
            'start_date' => '01/01/2020 08:00',
            'end_date' => '05/01/2020 16:00',
            'status' => 'Pending',
            'reasons' => 'Broken Arm because I fell off a hill while going mountain climbling with my friends during semester break'
        ]);

        DB::table('leave_application')->insert([
            'leave_id' => 'L000000',
            'leave_type' => 'Sick Leave',
            'student_id' => 'J00000000',
            'start_date' => '01/01/2020 08:00',
            'end_date' => '05/01/2020 16:00',
            'status' => 'Pending',
            'reasons' => 'Broken Arm because I fell off a hill while going mountain climbling with my friends during semester break'
        ]);

        DB::table('supporting_document')->insert([
            'leave_id' => 'L123456',
            'filename' => 'Testing.pdf'
        ]);

        DB::table('supporting_document')->insert([
            'leave_id' => 'L123456',
            'filename' => 'Test.png'
        ]);

        DB::table('supporting_document')->insert([
            'leave_id' => 'L000000',
            'filename' => 'Testing.pdf'
        ]);

        DB::table('staff')->insert([
            'staff_id' => 'S0001',
            'email_address' => 'lecturer1@gmail.com',
            'name' => 'Testing Lecturer 1 Name',
            'staff_type' => 'lecturer',
            'password' => Hash::make('test'),
        ]);

        DB::table('staff')->insert([
            'staff_id' => 'S0002',
            'email_address' => 'lecturer2@gmail.com',
            'name' => 'Testing Lecturer 2 Name',
            'staff_type' => 'lecturer',
            'password' => Hash::make('test'),
        ]);

        DB::table('staff')->insert([
            'staff_id' => 'S0003',
            'email_address' => 'hop@gmail.com',
            'name' => 'Testing HOP Name',
            'staff_type' => 'hop',
            'password' => Hash::make('test'),
        ]);

        DB::table('staff')->insert([
            'staff_id' => 'S0004',
            'email_address' => 'io@gmail.com',
            'name' => 'Testing IO Name',
            'staff_type' => 'io',
            'password' => Hash::make('test'),
        ]);

        DB::table('staff')->insert([
            'staff_id' => 'S0005',
            'email_address' => 'lecturer3@gmail.com',
            'name' => 'Testing Lecturer Name 3',
            'staff_type' => 'lecturer',
            'password' => Hash::make('test'),
        ]);

        DB::table('programme')->insert([
            'programme_id' => 'P0001',
            'programme_name' => 'Diploma in Information Technology',
            'head_of_programme' => 'S0003'
        ]);

        DB::table('course')->insert([
            'course_id' => 'IBM2104',
            'course_name' => 'Introduction to Web Programming with PHP'
        ]);

        DB::table('course')->insert([
            'course_id' => 'ICT2102',
            'course_name' => 'Introduction to Data Structure'
        ]);

        DB::table('section')->insert([
            'section_id' => 'SC0001',
            'section_name' => 'Y3',
            'lecturer_id' => 'S0001',
            'course_id' => 'IBM2104'
        ]);

        DB::table('section')->insert([
            'section_id' => 'SC0002',
            'section_name' => 'Y4',
            'lecturer_id' => 'S0002',
            'course_id' => 'ICT2102'
        ]);

        DB::table('session')->insert([
            'session_id' => 'SS0001',
            'section_id' => 'SC0001',
            'day_of_week' => 'Wednesday',
            'start_time' => '08:00:00',
            'end_time' => '10:00:00'
        ]);

        DB::table('session')->insert([
            'session_id' => 'SS0002',
            'section_id' => 'SC0002',
            'day_of_week' => 'Wednesday',
            'start_time' => '10:00:00',
            'end_time' => '12:00:00'
        ]);

        DB::table('leave_action')->insert([
            'leave_id' => 'L123456',
            'staff_authority' => 'lecturer',
            'staff_status' => 'Pending',
            'session_id' => 'SS0001',
            'remarks' => ''
        ]);

        DB::table('leave_action')->insert([
            'leave_id' => 'L123456',
            'staff_authority' => 'lecturer',
            'staff_status' => 'Pending',
            'session_id' => 'SS0002',
            'remarks' => ''
        ]);

        DB::table('leave_action')->insert([
            'leave_id' => 'L123456',
            'staff_authority' => 'hop',
            'staff_status' => 'Pending',
            'session_id' => 'NULL',
            'remarks' => ''
        ]);

        DB::table('leave_action')->insert([
            'leave_id' => 'L123456',
            'staff_authority' => 'io',
            'staff_status' => 'Pending',
            'session_id' => 'NULL',
            'remarks' => ''
        ]);

        DB::table('leave_action')->insert([
            'leave_id' => 'L000000',
            'staff_authority' => 'lecturer',
            'staff_status' => 'Pending',
            'session_id' => 'SS0001',
            'remarks' => ''
        ]);

        DB::table('leave_action')->insert([
            'leave_id' => 'L000000',
            'staff_authority' => 'lecturer',
            'staff_status' => 'Pending',
            'session_id' => 'SS0002',
            'remarks' => ''
        ]);

        DB::table('leave_action')->insert([
            'leave_id' => 'L000000',
            'staff_authority' => 'hop',
            'staff_status' => 'Pending',
            'session_id' => 'NULL',
            'remarks' => ''
        ]);

        Schema::enableForeignKeyConstraints();
    }
}

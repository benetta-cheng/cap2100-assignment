<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('session', function (Blueprint $table) {
            $table->foreign('section_id')->references('section_id')->on('section');
        });

        Schema::table('section', function (Blueprint $table) {
            $table->foreign('lecturer_id')->references('staff_id')->on('staff');
            $table->foreign('course_id')->references('course_id')->on('course');
        });

        Schema::table('leave_action', function (Blueprint $table) {
            $table->foreign('leave_id')->references('leave_id')->on('leave_application');
            $table->foreign('staff_id')->references('staff_id')->on('staff');
            $table->foreign('course_id')->references('course_id')->on('course');
        });

        Schema::table('leave_application', function (Blueprint $table) {
            $table->foreign('student_id')->references('student_id')->on('student');
        });

        Schema::table('programme', function (Blueprint $table) {
            $table->foreign('head_of_programme')->references('staff_id')->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('session', function (Blueprint $table) {
            $table->dropForeign('session_section_id_foreign');
        });
        Schema::table('section', function (Blueprint $table) {
            $table->dropForeign('section_lecturer_id_foreign');
            $table->dropForeign('section_course_id_foreign');
        });
        Schema::table('leave_action', function (Blueprint $table) {
            $table->dropForeign('leave_action_leave_id_foreign');
            $table->dropForeign('leave_action_staff_id_foreign');
            $table->dropForeign('leave_action_course_id_foreign');
        });
        Schema::table('leave_application', function (Blueprint $table) {
            $table->dropForeign('leave_application_student_id_foreign');
        });
        Schema::table('programme', function (Blueprint $table) {
            $table->dropForeign('programme_head_of_programme_foreign');
        });
    }
}

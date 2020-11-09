<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_application', function (Blueprint $table) {
            $table->string('leave_id')->primary();
            $table->string('leave_type');
            $table->string('student_id');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('status');
            $table->longText('reasons');
            $table->string('supporting_documents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_application');
    }
}

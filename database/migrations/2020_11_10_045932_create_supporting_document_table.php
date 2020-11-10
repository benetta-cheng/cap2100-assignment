<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportingDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporting_document', function (Blueprint $table) {
            $table->id();
            $table->string('leave_id');
            $table->string('filename');
            $table->timestamps();

            $table->foreign('leave_id')->references('leave_id')->on('leave_application');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supporting_document');
    }
}

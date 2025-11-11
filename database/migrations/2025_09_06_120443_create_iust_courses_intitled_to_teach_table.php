<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iust_courses_intitled_to_teach', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('iust_course_id')->nullable();
            $table->foreign('iust_course_id')->references('id')->on('iust_courses')->onDelete('cascade')->onUpdate('cascade');

            $table->string('ministerial_resolution_number');
            $table->boolean('being_taught_now');
            $table->string('note')->nullable();
            $table->date('date_created');
            $table->date('date_modified)');
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
        Schema::dropIfExists('iust_courses_intitled_to_teach');
    }
};

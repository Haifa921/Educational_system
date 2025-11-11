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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mother_name');

            $table->string('father_name');
            $table->string('national_number');
            $table->string('nationality');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('personal_image');
            $table->string('id_image');
            $table->string('gender');
            $table->string('general_specialization');
            $table->string('detailed_specialization'); 
            $table->string('scientific_rank'); 
            $table->date('scientific_rank_obtaining_date'); 
            $table->string('affiliated_government_agency');
            $table->boolean('is_contracted');
            $table->double('availability_days_count');
            $table->double('availability_hours_count');
          //  $table->integer('availability_id');
            $table->string('work_id');

            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('major_id')->nullable();
            $table->foreign('major_id')->references('id')->on('major')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('position_id')->nullable();
            $table->foreign('position_id')->references('id')->on('position')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('employee_status')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('employees');
    }
};

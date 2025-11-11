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
        Schema::create('certificate', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('certificate_type_id')->nullable();
            $table->foreign('certificate_type_id')->references('id')->on('certificate_type')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('specializaion_id')->nullable();
            $table->foreign('specializaion_id')->references('id')->on('certificate_specialization')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('certificate_country')->onDelete('cascade')->onUpdate('cascade');

            
            $table->string('thesis_title');
            $table->string('certificate_file');
            $table->date('release-date');
            $table->string('description');
            $table->string('company');
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
        Schema::dropIfExists('certificate');
    }
};

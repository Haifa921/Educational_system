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
        Schema::create('foreigners', function (Blueprint $table) {
            $table->id();
            $table->string('passport_number');
            $table->date('passport_release_date');
            $table->date('passport_valid_date');
            $table->string('security_approval_number');
            $table->date('security_approval_date');
            $table->string('security_approval_image');
            $table->string('work_approval_number');
            $table->date('work_approval_date');
            $table->string('work_approval_image');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('foreigners');
    }
};

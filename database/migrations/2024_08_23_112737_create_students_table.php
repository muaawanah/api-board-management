<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('registration')->unique();
            $table->string('name');
            $table->string('name_arabic')->nullable();
            $table->string('father_name');
            $table->string('father_name_arabic')->nullable();
            $table->date('date_of_birth');
            $table->string('address');
            $table->foreignId('area_id')->constrained();
            $table->foreignId('institute_id')->constrained();
            $table->foreignId('zamat_id')->constrained();
            $table->foreignId('exam_id')->constrained();
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
        Schema::dropIfExists('students');
    }
}

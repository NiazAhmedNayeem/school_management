<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->uniqid();
            $table->string('parent_id')->nullable();
            $table->string('student_name')->nullable();
            $table->string('student_phone')->nullable();
            $table->string('student_email')->nullable();
            $table->string('class_id')->nullable();
            $table->string('section_id')->nullable();
            $table->string('roll')->nullable();
            $table->string('student_address')->nullable();
            $table->string('student_image')->nullable();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('pre_school')->nullable();
            $table->string('pre_class')->nullable();
            $table->string('pre_section')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

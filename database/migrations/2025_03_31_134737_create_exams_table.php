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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->foreignId('ExamOrganizerID')->constrained('exam_organizers')->onDelete('cascade');
            $table->foreignId('ExamTypeID')->constrained('exam_types')->onDelete('cascade');
            $table->foreignId('ExamGroupID')->constrained('exam_groups')->onDelete('cascade');
            $table->foreignId('ExamYearID')->constrained('exam_years')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};

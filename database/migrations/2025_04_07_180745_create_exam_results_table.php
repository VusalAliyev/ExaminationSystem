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
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId'); // Tələbənin ID-si
            $table->unsignedBigInteger('examId'); // İmtahanın ID-si
            $table->integer('totalScore'); // Ümumi bal
            $table->integer('correctAnswers'); // Düzgün cavabların sayı
            $table->integer('wrongAnswers'); // Səhv cavabların sayı
            $table->integer('maxScore'); // İmtahanın maksimum mümkün balı
            $table->timestamp('completedAt'); // İmtahanın bitmə tarixi
            $table->timestamps();

            // Xarici açarlar (foreign keys)
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('examId')->references('id')->on('exams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};

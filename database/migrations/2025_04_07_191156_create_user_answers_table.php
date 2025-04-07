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
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId'); // Tələbənin ID-si
            $table->unsignedBigInteger('examId'); // İmtahanın ID-si
            $table->unsignedBigInteger('questionId'); // Sualın ID-si
            $table->unsignedBigInteger('answerId'); // Seçilmiş cavabın ID-si
            $table->timestamps();

            // Xarici açarlar (foreign keys)
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('examId')->references('id')->on('exams')->onDelete('cascade');
            $table->foreign('questionId')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('answerId')->references('id')->on('answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};

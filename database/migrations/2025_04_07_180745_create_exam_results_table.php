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
            $table->unsignedBigInteger('user_id'); // Tələbənin ID-si
            $table->unsignedBigInteger('exam_id'); // İmtahanın ID-si
            $table->integer('total_score'); // Ümumi bal
            $table->integer('correct_answers'); // Düzgün cavabların sayı
            $table->integer('wrong_answers'); // Səhv cavabların sayı
            $table->integer('max_score'); // İmtahanın maksimum mümkün balı
            $table->timestamp('completed_at'); // İmtahanın bitmə tarixi
            $table->timestamps();

            // Xarici açarlar (foreign keys)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
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

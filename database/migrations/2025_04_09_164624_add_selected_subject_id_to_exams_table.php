<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->foreignId('selected_subject_id')
                ->nullable() // Opsiyonel
                ->constrained('selected_subjects')
                ->onDelete('set null'); // Eğer SelectedSubject silinirse, bu alan null olur
        });
    }

    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropForeign(['selected_subject_id']);
            $table->dropColumn('selected_subject_id');
        });
    }
};

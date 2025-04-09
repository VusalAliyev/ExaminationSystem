<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('selected_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Name alanı, unique olacak
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('selected_subjects');
    }
};

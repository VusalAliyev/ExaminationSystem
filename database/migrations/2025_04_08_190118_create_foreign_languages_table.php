<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foreign_languages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Yabancı dil adı (örneğin, "English", "French")
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foreign_languages');
    }
};

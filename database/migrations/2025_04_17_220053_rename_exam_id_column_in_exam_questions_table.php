<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('exam_questions', function (Blueprint $table) {
            $table->renameColumn('ExamID', 'exam_id');
        });
    }

    public function down()
    {
        Schema::table('exam_questions', function (Blueprint $table) {
            $table->renameColumn('exam_id', 'ExamID');
        });
    }
};

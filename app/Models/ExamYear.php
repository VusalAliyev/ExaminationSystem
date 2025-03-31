<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamYear extends Model
{
    protected $fillable = ['Year'];

    public function exams()
    {
        return $this->hasMany(Exam::class, 'ExamYearID');
    }
}

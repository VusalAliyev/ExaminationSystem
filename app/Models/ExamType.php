<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    protected $fillable = ['Type'];

    public function exams()
    {
        return $this->hasMany(Exam::class, 'ExamTypeID');
    }
}

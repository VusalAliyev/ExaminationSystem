<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamOrganizer extends Model
{
    protected $fillable = ['name'];

    public function exams()
    {
        return $this->hasMany(Exam::class, 'exam_organizer_id');
    }
}

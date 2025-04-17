<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'exam_subject_id',
        'question_content',
        'point',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function subject()
    {
        return $this->belongsTo(ExamSubject::class, 'exam_subject_id');
    }

    public function answers()
    {
        return $this->hasMany(ExamAnswer::class, 'exam_question_id');
    }

    public function questionImages()
    {
        return $this->hasMany(QuestionImage::class, 'exam_question_id');
    }
}

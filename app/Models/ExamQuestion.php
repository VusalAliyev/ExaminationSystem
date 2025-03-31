<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    protected $fillable = ['QuestionContent', 'Point', 'ExamSubjectID', 'ExamID'];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'ExamID');
    }

    public function subject()
    {
        return $this->belongsTo(ExamSubject::class, 'ExamSubjectID');
    }

    public function answers()
    {
        return $this->hasMany(ExamAnswer::class, 'ExamQuestionID');
    }

    public function images()
    {
        return $this->hasMany(QuestionImage::class, 'ExamQuestionID');
    }
}

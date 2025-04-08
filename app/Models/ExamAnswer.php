<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    protected $fillable = ['answer_content', 'state', 'exam_question_id'];

    public function question()
    {
        return $this->belongsTo(ExamQuestion::class, 'exam_question_id');
    }

    public function images()
    {
        return $this->hasMany(AnswerImage::class, 'exam_answer_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    protected $fillable = ['AnswerContent', 'State', 'ExamQuestionID'];

    public function question()
    {
        return $this->belongsTo(ExamQuestion::class, 'ExamQuestionID');
    }

    public function images()
    {
        return $this->hasMany(AnswerImage::class, 'ExamAnswerID');
    }
}

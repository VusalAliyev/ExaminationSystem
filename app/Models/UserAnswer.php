<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $fillable = ['userId', 'examId', 'questionId', 'answerId'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'examId');
    }

    public function question()
    {
        return $this->belongsTo(ExamQuestion::class, 'questionId');
    }

    public function answer()
    {
        return $this->belongsTo(ExamAnswer::class, 'answerId');
    }
}

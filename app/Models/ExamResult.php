<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $fillable = [
        'user_id',
        'exam_id',
        'total_score',
        'correct_answers',
        'wrong_answers',
        'max_score',
        'completed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}

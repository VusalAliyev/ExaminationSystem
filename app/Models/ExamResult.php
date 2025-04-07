<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $fillable = [
        'userId',
        'examId',
        'totalScore',
        'correctAnswers',
        'wrongAnswers',
        'maxScore',
        'completedAt',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'examId');
    }
}

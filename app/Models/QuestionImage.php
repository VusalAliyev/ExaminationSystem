<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionImage extends Model
{
    protected $fillable = ['ImagePath', 'ExamQuestionID'];

    public function question()
    {
        return $this->belongsTo(ExamQuestion::class, 'ExamQuestionID');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerImage extends Model
{
    protected $fillable = ['image_path', 'exam_answer_id'];

    public function answer()
    {
        return $this->belongsTo(ExamAnswer::class, 'exam_answer_id');
    }
}

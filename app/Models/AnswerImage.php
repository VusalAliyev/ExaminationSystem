<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerImage extends Model
{
    protected $fillable = ['ImagePath', 'ExamAnswerID'];

    public function answer()
    {
        return $this->belongsTo(ExamAnswer::class, 'ExamAnswerID');
    }
}

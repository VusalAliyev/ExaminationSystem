<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSubject extends Model
{
    protected $fillable = ['name'];

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class, 'exam_subject_id');
    }
}

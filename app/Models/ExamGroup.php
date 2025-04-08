<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamGroup extends Model
{
    protected $fillable = ['group_name'];

    public function exams()
    {
        return $this->hasMany(Exam::class, 'exam_group_id');
    }
}

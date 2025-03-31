<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamGroup extends Model
{
    protected $fillable = ['GroupNumber'];

    public function exams()
    {
        return $this->hasMany(Exam::class, 'ExamGroupID');
    }
}

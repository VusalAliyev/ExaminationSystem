<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    protected $fillable = ['type'];

    public function exams()
    {
        return $this->hasMany(Exam::class, 'exam_type_id');
    }

    // Buraxılış imtahanı olub-olmadığını yoxlamaq üçün metod
    public function isGraduation()
    {
        return $this->type === 'Buraxılış'; // Və ya $this->id === 1, əgər ID ilə yoxlamaq istəyirsən
    }
}

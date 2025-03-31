<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSubject extends Model
{
    protected $fillable = ['Name'];

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class, 'ExamSubjectID');
    }
}

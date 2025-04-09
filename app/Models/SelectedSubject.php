<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedSubject extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Exam ile ilişki
    public function exams()
    {
        return $this->hasMany(Exam::class, 'selected_subject_id');
    }
}

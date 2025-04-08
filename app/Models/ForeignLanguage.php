<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Bir ForeignLanguage, birden fazla Exam ile ilişkilidir (one-to-many)
    public function exams()
    {
        return $this->hasMany(Exam::class, 'foreign_language_id');
    }
}

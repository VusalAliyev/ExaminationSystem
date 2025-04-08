<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $fillable = ['sector_name'];
    use HasFactory;
    public function exams()
    {
        return $this->hasMany(Exam::class, 'sector_id');
    }
}

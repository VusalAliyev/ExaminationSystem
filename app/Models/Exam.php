<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['Name', 'ExamOrganizerID', 'ExamTypeID', 'ExamGroupID', 'ExamYearID'];

    public function organizer()
    {
        return $this->belongsTo(ExamOrganizer::class, 'ExamOrganizerID');
    }

    public function type()
    {
        return $this->belongsTo(ExamType::class, 'ExamTypeID');
    }

    public function group()
    {
        return $this->belongsTo(ExamGroup::class, 'ExamGroupID');
    }

    public function year()
    {
        return $this->belongsTo(ExamYear::class, 'ExamYearID');
    }

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class, 'ExamID');
    }
}

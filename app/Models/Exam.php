<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    // Fillable alanlar
    protected $fillable = [
        'name',
        'exam_organizer_id',
        'exam_type_id',
        'exam_group_id',
        'exam_year_id',
        'sector_id',
        'foreign_language_id',
        'selected_subject_id', // Yeni eklenen sütun
    ];

    // ExamOrganizer ile ilişki
    public function organizer()
    {
        return $this->belongsTo(ExamOrganizer::class, 'exam_organizer_id');
    }

    // Sector ile ilişki
    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }

    // ExamType ile ilişki
    public function type()
    {
        return $this->belongsTo(ExamType::class, 'exam_type_id');
    }

    // ExamGroup ile ilişki
    public function group()
    {
        return $this->belongsTo(ExamGroup::class, 'exam_group_id');
    }

    // ExamYear ile ilişki
    public function year()
    {
        return $this->belongsTo(ExamYear::class, 'exam_year_id');
    }

    // ExamQuestion ile ilişki
    public function questions()
    {
        return $this->hasMany(ExamQuestion::class, 'ExamID');
    }

    // ForeignLanguage ile ilişki
    public function foreignLanguage()
    {
        return $this->belongsTo(ForeignLanguage::class, 'foreign_language_id');
    }

    // SelectedSubject ile ilişki
    public function selected_subject()
    {
        return $this->belongsTo(SelectedSubject::class, 'selected_subject_id');
    }
}

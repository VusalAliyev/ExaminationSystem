<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    // foreign_language_id sütununu fillable'a ekle
    protected $fillable = [
        'name',
        'exam_organizer_id',
        'exam_type_id',
        'exam_group_id',
        'exam_year_id',
        'sector_id', // Daha önceki adımda eklenmişti
        'foreign_language_id', // Yeni eklenen sütun
    ];

    public function organizer()
    {
        return $this->belongsTo(ExamOrganizer::class, 'exam_organizer_id');
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }

    public function type()
    {
        return $this->belongsTo(ExamType::class, 'exam_type_id');
    }

    public function group()
    {
        return $this->belongsTo(ExamGroup::class, 'exam_group_id');
    }

    public function year()
    {
        return $this->belongsTo(ExamYear::class, 'exam_year_id');
    }

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class, 'ExamID');
    }

    // Bir Exam, bir ForeignLanguage'e aittir (many-to-one)
    public function foreignLanguage()
    {
        return $this->belongsTo(ForeignLanguage::class, 'foreign_language_id');
    }
}

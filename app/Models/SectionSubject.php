<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionSubject extends Model
{
    use HasFactory;


    protected $table = 'section_subjects';
    protected $primaryKey = 'section_subject_id';

    protected $fillable = [
        'academic_year_id',
        'grade_level',
        'section_id', 
        'track_id',
        'semester_id',
        'strand_id',
        'subject_id'
    ];


    

    public function academic_year(){
        return $this->hasOne(AcademicYear::class, 'academic_year_id', 'academic_year_id');
    }

    public function section(){
        return $this->hasOne(Section::class, 'section_id', 'section_id');
    }

    public function semester(){
        return $this->hasOne(Semester::class, 'semester_id', 'semester_id');
    }

    public function track(){
        return $this->hasOne(Track::class, 'track_id', 'track_id');
    }

    public function strand(){
        return $this->hasOne(Strand::class, 'strand_id', 'strand_id');
    }

    public function subject(){
        return $this->hasOne(Subject::class, 'subject_id', 'subject_id');
    }

}

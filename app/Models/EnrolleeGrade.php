<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrolleeGrade extends Model
{
    use HasFactory;

    
    protected $table = 'enrollee_grades';
    protected $primaryKey = 'enrollee_grade_id';

    protected $fillable = [
        'academic_year_id',
        'enroll_id', 
        'grade_level',
        'learner_id', 
        'section_id',
        'semester_id',
        'track_id',
        'strand_id',
        'subject_id',
        'grade'
    ];

    public function track(){
        return $this->belongsTo(Track::class, 'track_id', 'track_id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
    }


}

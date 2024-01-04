<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    use HasFactory;

    protected $table = 'enrolls';
    protected $primaryKey = 'enroll_id';


    protected $fillable = [
        'academic_year_id',
        'grade_level',
        'learner_status',
        'learner_id',
        'section_id',
        'semester_id',
        'track_id',
        'strand_id',
        'admission_date',
        'date_enrolled',
        'is_enrolled',
        'section_id',
    ];

    public function academic_year(){
        return $this->hasOne(AcademicYear::class, 'academic_year_id', 'academic_year_id');
    }

    public function learner(){
        return $this->hasOne(Learner::class, 'learner_id', 'learner_id');
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

    public function section(){
        return $this->hasOne(Section::class, 'section_id', 'section_id');
    }

    public function grade_level(){
        return $this->hasOne(GradeLevel::class, 'grade_level', 'grade_level');
    }

    public function section_subjects(){
        return $this->hasMany(EnrollSubject::class, 'enroll_id', 'enroll_id')
        ->with(['teacher']);
    }

    
    public function subjects(){
        return $this->hasMany(EnrollSubject::class, 'enroll_id', 'enroll_id');
    }

    public function grades(){

        return $this->hasMany(EnrolleeGrade::class, 'enroll_id', 'enroll_id');
    }
    public function billing(){
        return $this->hasOne(Billing::class, 'enroll_id', 'enroll_id');
    }

   

}

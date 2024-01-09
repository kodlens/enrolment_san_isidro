<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learner extends Model
{
    use HasFactory;


    protected $table = 'learners';
    protected $primaryKey = 'learner_id';

    protected $fillable = [
        'student_id',
        'academic_year_id',
        'grade_level',
        'learner_status',
        'lrn',
        'lname',
        'fname',
        'mname',
        'extension',
        'sex',
        'birthdate',
        'birthplace',
        'age',
        'last_school_attended',
        
        'country',
        'province',
        'city',
        'barangay',
        'street',
        'zipcode',

        

        'email',
        'contact_no',
        'religion',

        'mother_tongue',
        'ip',

        'father_lname',
        'father_fname',
        'father_mname',
        'father_extension',
        'father_contact_no',
        'father_education',
        'father_religion',
        
        'mother_maiden_lname',
        'mother_maiden_fname',
        'mother_maiden_mname',
        'mother_maiden_contact_no',
        'mother_education',
        'mother_education',
        'mother_religion',

        'guardian_lname',
        'guardian_fname',
        'guardian_mname',
        'guardian_extension',
        'guardian_contact_no',
        'guardian_relationship',


        // 'last_grade_level_completed',
        // 'last_school_year_completed',
        // 'last_school_attended',
        // 'last_schoold_id',

        'semester_id',
        'senior_high_school_id',
        'track_id',
        'strand_id',

    ];


    public function semester(){
        return $this->hasOne(Semester::class, 'semester_id', 'semester_id');
    }

    public function strand(){
        return $this->hasOne(Strand::class, 'strand_id', 'strand_id');
    }

    public function track(){
        return $this->hasOne(Track::class, 'track_id', 'track_id');
    }

    public function section(){
        return $this->hasOne(Section::class, 'section_id', 'section_id');
    }

    public function grade_level(){
        return $this->hasOne(GradeLevel::class, 'grade_level', 'grade_level');
    }



    public function province(){
        return $this->hasOne(Province::class, 'provCode', 'province');
    }
    public function city(){
        return $this->hasOne(City::class, 'citymunCode', 'city');
    }
    public function barangay(){
        return $this->hasOne(Barangay::class, 'brgyCode', 'barangay');
    }


    public function credentials(){
        return $this->hasMany(EnrolleeCredential::class, 'learner_id', 'learner_id');
    }





}

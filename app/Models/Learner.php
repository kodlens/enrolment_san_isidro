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

        'current_country',
        'current_province',
        'current_city',
        'current_barangay',
        'current_street',
        'current_zipcode',


        'email',
        'contact_no',

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

        'last_grade_level_completed',
        'last_school_year_completed',
        'last_school_attended',
        'last_schoold_id',

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


    public function current_province(){
        return $this->hasOne(Province::class, 'provCode', 'current_province');
    }
    public function current_city(){
        return $this->hasOne(City::class, 'citymunCode', 'current_city');
    }
    public function current_barangay(){
        return $this->hasOne(Barangay::class, 'brgyCode', 'current_barangay');
    }

    public function permanent_province(){
        return $this->hasOne(Province::class, 'provCode', 'permanent_province');
    }
    public function permanent_city(){
        return $this->hasOne(City::class, 'citymunCode', 'permanent_city');
    }
    public function permanent_barangay(){
        return $this->hasOne(Barangay::class, 'brgyCode', 'permanent_barangay');
    }



}

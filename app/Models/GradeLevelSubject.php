<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeLevelSubject extends Model
{
    use HasFactory;


    
    protected $table = 'grade_level_subjects';
    protected $primaryKey = 'grade_level_subject_id';

    protected $fillable = [
       
        'grade_level',
        'curriculum_code',
        'subject_id',
        'semester_id'
    ];


    public function subject(){
        return $this->hasOne(Subject::class, 'subject_id', 'subject_id');
    }

    public function semester(){
        return $this->hasOne(Semester::class, 'semester_id', 'semester_id');
    }


}

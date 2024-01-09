<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollSubject extends Model
{
    use HasFactory;

    protected $table = 'enroll_subjects';
    protected $primaryKey = 'enroll_subject_id';


    protected $fillable = [
        'enroll_id',
        'subject_id',
        'grade',
        'teacher_id',
        'first_grading',
        'second_grading',
        'third_grading',
        'fourth_grading',
        'remarks'
    ];


    public function subject(){
        return $this->hasOne(Subject::class, 'subject_id', 'subject_id');
    }

    public function teacher(){
        return $this->hasOne(User::class, 'user_id', 'teacher_id');
    }

}

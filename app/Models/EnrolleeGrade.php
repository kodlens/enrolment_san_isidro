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
        'enroll_id', 
        'learner_id', 
        'section_id',
        'grade'
    ];

    public function track(){
        return $this->belongsTo(Track::class, 'track_id', 'track_id');
    }


}

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


    

    public function strand(){
        return $this->hasOne(Strand::class, 'strand_id', 'strand_id');
    }

}

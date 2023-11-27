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
    ];


    public function subject(){
        return $this->hasOne(Subject::class, 'subject_id', 'subject_id');
    }

}

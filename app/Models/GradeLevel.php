<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeLevel extends Model
{
    use HasFactory;

    protected $table = 'grade_levels';
    protected $primaryKey = 'grade_level_id';


    protected $fillable = ['grade_level', 'curriculum_code', 'active'];

}

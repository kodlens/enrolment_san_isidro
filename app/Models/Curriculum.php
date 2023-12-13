<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';
    protected $primaryKey = 'curriculum_id';

    protected $fillable = ['curriculum_code',
        'curriculum_description',
        'active'
    ];

    
}

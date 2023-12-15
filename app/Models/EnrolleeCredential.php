<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrolleeCredential extends Model
{
    use HasFactory;

    protected $table = 'enrollee_credentials';
    protected $primaryKey = 'enrollee_credential_id';

    protected $fillable = [
        'learner_id',
        'credential_name',
        'file_path', 
    
    ];


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    use HasFactory;


    
    protected $table = 'religions';
    protected $primaryKey = 'religion_id';


    protected $fillable = ['religion'];


}

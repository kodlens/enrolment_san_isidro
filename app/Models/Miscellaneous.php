<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miscellaneous extends Model
{
    use HasFactory;

    protected $table = 'miscellaneous';
    protected $primaryKey = 'misc_id';


    protected $fillable = [
        'description',
        'amount',
    ];



}

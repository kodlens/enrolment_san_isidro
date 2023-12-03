<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $table = 'billings';
    protected $primaryKey = 'billing_id';


    protected $fillable = [
        'academic_year_id',
        'enroll_id',
        'learner_id',
        'date_bill',
        'fee_balance'
    ];



}

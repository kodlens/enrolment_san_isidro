<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingPayment extends Model
{
    use HasFactory;

    protected $table = 'billing_payments';
    protected $primaryKey = 'billing_payment_id';


    protected $fillable = [
        'billing_payment_id',
        'academic_year_id',
        'enroll_id',
        'user_id',
        'date_paid',
        'payment'
    ];

}

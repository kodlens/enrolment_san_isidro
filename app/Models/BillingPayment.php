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
        'billing_id',
        'academic_year_id',
        'enroll_id',
        'learner_id',
        'date_paid',
        'current_balance',
        'payment',
        'remarks'
    ];
 

    public function billing(){
        return $this->hasOne(Billing::class, 'billing_id', 'billing_id');
    }

}

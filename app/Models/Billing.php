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


    public function academic_year(){
        return $this->hasOne(AcademicYear::class, 'academic_year_id', 'academic_year_id');
    }

    public function learner(){
        return $this->hasOne(Learner::class, 'learner_id', 'learner_id');
    }

    public function enrollee(){
        return $this->hasOne(Enroll::class, 'enroll_id', 'enroll_id');
    }

    public function billing_payment(){
        return $this->hasMany(BillingPayment::class, 'billing_id', 'billing_id')
            ->orderBy('billing_payment_id', 'asc');
    }

    public function payment_history(){
        return $this->hasMany(BillingPayment::class, 'billing_id', 'billing_id')
            ->orderBy('date_paid', 'desc');
    }


}

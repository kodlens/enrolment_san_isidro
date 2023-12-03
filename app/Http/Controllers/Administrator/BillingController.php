<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    //


    public function store(Request $req){

        $req->validate([
            'academic_year_id' => ['required'],
            'enroll_id' => ['required'],
            'user_id' => ['required'],
        ]);

        Billing::create([
            'academic_year_id' => $req->academic_year_id,
            'enroll_id' => $req->enroll_id,
            'learner_id' => $req->learner_id,
            'date_bill' => date('Y-m-d'),
            'fee_balance' => $req->fee_balance,

        ]);


    }
}

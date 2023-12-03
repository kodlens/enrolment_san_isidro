<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BillingPayment;
use App\Models\Billing;


class BillingPaymentController extends Controller
{
    //

    public function index(){
        return view('administrator.billing.billing-payment');
    }


    public function getData(Request $req){

    }

    public function store(Request $req){
        
        $req->validate([
            'billing_id' => ['required'],
            'academic_year_id' => ['required'],
            'enroll_id' => ['required'],
            'learner_id' => ['required'],

        ]);

        if($req->fee_balance < $req->payment){
            return response()->json([
                'errors' => [
                    'lower' => ['Payment should not be bigger than balance.']
                ]
            ], 422);
        }

        BillingPayment::create([
            'billing_id' => $req->billing_id,
            'academic_year_id' => $req->academic_year_id,
            'enroll_id' => $req->enroll_id,
            'learner_id' => $req->learner_id,
            'date_paid' => date('Y-m-d', strtotime($req->date_paid)),
            'current_balance' => $req->fee_balance,
            'payment' => $req->payment
        ]);

        Billing::where('billing_id', $req->billing_id)
            ->decrement('fee_balance', $req->payment);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }
}

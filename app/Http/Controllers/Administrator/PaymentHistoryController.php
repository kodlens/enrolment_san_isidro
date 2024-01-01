<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\BillingPayment;

class PaymentHistoryController extends Controller
{
    //

    public function index($id){
        $payments = Billing::with(['learner', 'payment_history'])
            ->where('learner_id', $id)
            //->orderBy('date_paid', 'desc')
            ->first();

        return view('administrator.payment-history.payment-history-index')
            ->with('learner_id', $id)
            ->with('payments', $payments);
    }

    public function getData(Request $req){
        $payments = BillingPayment::where('learner_id', $req->learner)
        ->orderBy('date_paid', 'desc')
        ->get();

        return $payments;
    }
}

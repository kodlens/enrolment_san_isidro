<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Billing;
use App\Models\Enroll;


class CashierController extends Controller
{
    //

    public function index(){
        return view('administrator.cashier.cashier-page');
    }

    public function getData(Request $req){
        
    }

    public function store(Request $req){
        $req->validate([
            'academic_year_id' => ['required'],
            'enroll_id' => ['required'],
            'learner_id' => ['required'],
            //'user_id' => ['required'],

        ]);


        
        $exist = Billing::where('academic_year_id', $req->academic_year_id)
            ->where('learner_id', $req->learner_id)
            ->where('enroll_id', $req->enroll_id)
            ->exists();
        if($exist){
            return response()->json([
                'errors' => [
                    'exist' => ['Already enrolled in the system.']
                ],
                'message' => 'The given data was invalid.'
            ], 422);
        }


        Billing::create([
            'academic_year_id' => $req->academic_year_id,
            'enroll_id' => $req->enroll_id,
            'learner_id' => $req->learner_id,
            'date_bill' => date('Y-m-d'),
            'fee_balance' => $req->fee_balance,

        ]);

        $data = Enroll::find($req->enroll_id);
        $data->is_enrolled = 1;
        $data->date_enrolled = date('Y-m-d');
        $data->save();

        return response()->json([
            'status' => 'saved'
        ], 200);
    }
    


    public function enrolleeSubjects($id){
        return EnrollSubject::where('enroll_id', $id)
            ->get();
    }
}

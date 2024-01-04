<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtherFeesController extends Controller
{
    //

    public function index(){
        return view('administrator.other-fees.other-fees-index');
    }



    public function store(Request $req){
        $req->validate([
            'description' => ['required'],
            'amount' => ['required']
        ]);

        
    }


}

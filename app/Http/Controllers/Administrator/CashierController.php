<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    //

    public function index(){
        return view('administrator.cashier.cashier-page');
    }

    public function getData(Request $req){
        
    }
}

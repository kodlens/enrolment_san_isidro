<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnrolementController extends Controller
{
    //

    public function index(){
        return view('administrator.enrolement.enrolement-index');
    }
}
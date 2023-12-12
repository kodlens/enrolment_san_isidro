<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnrolleeGradeController extends Controller
{
    //


    public function index(){
        return view('administrator.enrollee_grade.enrollee-grade-index');
    }


    
}

<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MySubjectController extends Controller
{
    //

    public function index(){
        return view('teacher.my-subject');
    }
}

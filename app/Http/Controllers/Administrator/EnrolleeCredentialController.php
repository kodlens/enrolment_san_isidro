<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnrolleeCredentialController extends Controller
{
    //

    public function index(){
        return view('administrator.enrollee_credential.enrollee-credential-index');
    }


}

<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EnrolleeCredential;


class EnrolleeCredentialController extends Controller
{
    //

    public function index(){
        return view('administrator.enrollee_credential.enrollee-credential-index');
    }

    public function store(Request $req){
        
        $req->validate([
            'learner_id' => ['required'],
            'credentials.*.credential_name' => ['required'],
            'credentials.*.credential' => ['mimes:pdf']

        ],[
            'learner_id.required' => 'Please select learner.',
            'credentials.*.credential_name' => 'Please add description for the file.'
        ]);


        if($req->has('credentials')){
            foreach($req->credentials as $item){
                $n = [];
                if($item['credential']){
                    $pathFile = $item['credential']->store('public/credentials'); //get path of the file
                    $n = explode('/', $pathFile); //split into array using /
                }

                //insert into database after upload 1 image
                EnrolleeCredential::create([
                    'learner_id' => $req->learner_id,
                    'credential_name' => $item['credential_name'],
                    'file_path' => $n[2]
                ]);
            }
        }
        
        return response()->json([
            'status' => 'saved'
        ], 200);
        return $req;
    }

}

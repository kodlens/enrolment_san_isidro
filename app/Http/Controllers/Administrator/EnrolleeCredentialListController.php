<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Learner;


class EnrolleeCredentialListController extends Controller
{
    //

    public function index(){
        return view('administrator.enrollee_credential.enrollee-credential-list-index');
    }


    public function getData(Request $req){

        $sort = explode('.', $req->sort_by);

        $data = Learner::with(['credentials',
            'section', 'track', 'strand'
            ])
            ->where('lname','like', $req->name . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
        return $data;

    }
}

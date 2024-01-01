<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssignTeacherController extends Controller
{
    //


    public function index(){
        return view('administrator.assign-teacher.assign-teacher-index');
    }


    public function getData(){

        $sort = explode('.', $req->sort_by);
        
        $data = EnrollSubject::where('')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }

}

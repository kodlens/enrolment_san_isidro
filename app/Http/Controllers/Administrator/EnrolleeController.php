<?php

namespace App\Http\Controllers\Administrator;
use App\Http\Controllers\Controller;
use App\Models\Enroll;

use Illuminate\Http\Request;

class EnrolleeController extends Controller
{

    public function index(){
        return view('administrator.enrollee.enrollee-page');
    }
    public function getEnrollees(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = Enroll::with(['academic_year', 'learner', 
                'semester', 'track', 'strand', 
                'section', 'subjects.subject'
            ])
            ->whereHas('learner', function($q) use ($req){
                $q->where('lname', 'like', '%' . $req->lname . '%')
                    ->orWhere('fname', 'like', '%' . $req->lname . '%');
            })
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
        return $data;
    }

    public function create(){
        return view('administrator.enrollee.enrollee-create-edit')
            ->with('id', 0);
    }


    public function destroy($id){
        Enroll::destroy($id);
        return response()->json([
            'status' => 'deleted'
        ], 200);
    }

}
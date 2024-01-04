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
                'section', 'section_subjects.subject'
            ])
            ->whereHas('learner', function($q) use ($req){
                $q->where('lname', 'like', '%' . $req->name . '%')
                    ->orWhere('fname', 'like', '%' . $req->name . '%');
            })
            ->where('grade_level', 'like', $req->grade. '%')
            ->where('academic_year_id', $req->ayid)
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


    public function getBrowseEnrollees(Request $req){
        $sort = explode('.', $req->sort_by);
        $ayId = $req->ayid;
        $studentId = $req->student;

        $data = Enroll::with(['learner', 'semester', 'track', 'strand', 
            'section', 
            'grade_level', 
            'section_subjects.subject'

            ])
            ->where('academic_year_id', $ayId)
            ->whereHas('learner', function($q) use ($req){
                $q->where('student_id', 'like', $req->student_id . '%')
                    ->where('lname', 'like', $req->lname . '%')
                    ->where('fname', 'like', $req->fname . '%');
            })
            //->where('is_enrolled', 0)
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);   
            
        return $data;
    }





    

    public function coeIndex($learnerId, $ayId){
        return view('administrator.enrollee.report.coe-index')
            ->with('learnerId', $learnerId)
            ->with('ayId', $ayId);
    }

    public function getReportLearner($learnerId, $ayId){
        $data = Enroll::with(['academic_year', 'learner', 
            'semester', 'track', 'strand', 
            'billing.billing_payment',
            'section', 'section_subjects.subject'
        ])
        ->where('academic_year_id', $ayId)
        ->where('learner_id', $learnerId)
        ->first();


        return $data;
    }


}
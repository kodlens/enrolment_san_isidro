<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enroll;
use App\Models\AcademicYear;
use App\Models\EnrollSubject;
use Auth;

class EnrollmentController extends Controller
{
    //

    public function index(){
        return view('administrator.enrollment.enrollment-index');
    }



    public function store(Request $req){
        
        

        $req->validate([
            'learner_id' => ['required'],
            'grade_level' => ['required'],
            'subjects' => ['required'],
            'section_id' => ['required']
            

        ],[
            'learner_id.required' => 'Please select learner.',
            'subjects.required' => 'Please add some subject/s.',

        ]);

        $ay = AcademicYear::where('is_active', 1)->first();
        $user = Auth::user();

        $track_id = 0;
        $strand_id = 0;
        //if grade 11 and 12, assign track, 
        if($req->grade_level == 'GRADE 11' || $req->grade_level == 'GRADE 12'){
            $track_id = $req->track_id;
            $strand_id = $req->strand_id;
        }

        
        //check if already enrol
        $exist = Enroll::where('learner_id', $req->learner_id)
            ->where('academic_year_id', $ay->academic_year_id)
            ->exists();
        if($exist){
            return response()->json([
                'errors' => [
                    'message' => ['exist']
                ]
            ], 422);
        }


        $enroll = Enroll::create([
            'academic_year_id' => $ay->academic_year_id,
            'grade_level' => $req->grade_level,
            'learner_status' => $req->learner_status,
            'learner_id' => $req->learner_id,
            'semester_id' => $req->semester_id,
            'track_id' => $track_id,
            'strand_id' => $strand_id,
            'section_id' => $req->section_id,
            'date_enrolled' => date('Y-m-d', strtotime($req->date_enrolled)),
            'administer_by' => $user->username
        ]);

        $arr=[];
        foreach($req->subjects as $subj){
            array_push($arr,[
                'subject_id' => $subj['subject_id'],
                'enroll_id' => $enroll['enroll_id'],
            ]);
        }

        EnrollSubject::insert($arr);

        return response()->json([
            'status' => 'saved'
        ], 200);

       
    }
}

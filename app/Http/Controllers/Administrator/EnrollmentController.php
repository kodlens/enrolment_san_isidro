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
        return view('administrator.admission.admission-index');
    }

    public function store(Request $req){
        

        $req->validate([
            'learner_id' => ['required'],
            'grade_level' => ['required'],
            'section_id' => ['required'],
            'semester_id' => ['required_if:grade_level.curriculum_code,SHS'],
            'track_id' => ['required_if:grade_level.curriculum_code,SHS'],
            'strand_id' => ['required_if:grade_level.curriculum_code,SHS'],
        ],[
            'learner_id.required' => 'Please select learner.',
            'section_id.required' => 'Section is required.',
            'semester_id.required_if' => 'Curriculum is SHS, semester is required.',
            'track_id.required_if' => 'Curriculum is SHS, track is required.',
            'strand_id.required_if' => 'Curriculum is SHS, strand is required.',
        ]);
        //return $req;
        
        $ay = AcademicYear::where('is_active', 1)->first();
        $user = Auth::user();

      
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
            'grade_level' => $req->grade_level['grade_level'],
            'learner_status' => $req->learner_status,
            'learner_id' => $req->learner_id,
            'semester_id' => $req->grade_level['curriculum_code'] == 'SHS' ? $req->semester_id : null,
            'track_id' => $req->grade_level['curriculum_code'] == 'SHS' ? $req->track_id : null,
            'strand_id' => $req->grade_level['curriculum_code'] == 'SHS' ? $req->strand_id : null,
            'section_id' => $req->section_id,
            'admission_date' => date('Y-m-d', strtotime($req->admission_date)),
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

<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EnrolleeGrade;
use App\Models\EnrollSubject;
use App\Models\AcademicYear;

class EnrolleeGradeController extends Controller
{
    //


    public function index(){
        return view('administrator.enrollee_grade.enrollee-grade-index');
    }


    public function store(Request $req){
        //return $req->academic_year_id;
        $req->validate([
            'academic_year_id' => ['required'],
            'learner_id' => ['required'],
            'enroll_id' => ['required'],
            'section_id' => ['required'],
            'semester_id' => ['required_if:curriculum,SHS'],
            'track_id' => ['required_if:curriculum,SHS'],
            'strand_id' => ['required_if:curriculum,SHS'],

        ],[
            //'academic_year_id.required' => 'Please select academic year.',
            'learner_id.required' => 'Please select learner.',
            'enroll_id.required' => 'Please select learner.',
            'section_id.required' => 'Please select section.',
            'semester_id.required_if' => 'Curriculum is SHS, semester is required.',
            'track_id.required_if' => 'Curriculum is SHS, track is required.',
            'strand_id.required_if' => 'Curriculum is SHS, strand is required.',
        ]);
        
        foreach($req->section_subjects as $item){
      
            EnrolleeGrade::updateOrCreate([
                'enroll_id' => $req->enroll_id,
                'subject_id' => $item['subject_id']
            ],[
                'enroll_id' => $req->enroll_id,
                'subject_id' => $item['subject_id'],
                'grade' => $item['grade']
            ]);
        }


        return response()->json([
            'status' => 'saved'
        ], 200);
    }






    public function getEnrolleeGradeByLearner(Request $req){

        $enrolId = $req->enroll;
        $data = EnrolleeGrade::where('enroll_id', $enrolId)
            ->get();

        return $data;
    }


    public function checkAlreadyHaveGrade($enrollId){
        $exist = EnrolleeGrade::where('enroll_id', $enrollId)
            ->exists();

        if($exist){
            return EnrolleeGrade::with('subject')
                ->where('enroll_id', $enrollId)
                ->get();
        }else{
            return 0;
        }
    }
    
}

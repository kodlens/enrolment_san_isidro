<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EnrolleeGrade;

class EnrolleeGradeController extends Controller
{
    //


    public function index(){
        return view('administrator.enrollee_grade.enrollee-grade-index');
    }


    public function store(Request $req){
        
        $req->validate([
            'academic_year_id' => ['required'],
            'learner_id' => ['required'],
            'enroll_id' => ['required'],
            'section_id' => ['required'],
            'semester_id' => ['required_if:curriculum,SHS'],
            'track_id' => ['required_if:curriculum,SHS'],
            'strand_id' => ['required_if:curriculum,SHS'],

        ],[
            'academic_year_id.required' => 'Please select academic year.',
            'learner_id.required' => 'Please select learner.',
            'enroll_id.required' => 'Please select learner.',
            'section_id.required' => 'Please select section.',
            'semester_id.required_if' => 'Curriculum is SHS, semester is required.',
            'track_id.required_if' => 'Curriculum is SHS, track is required.',
            'strand_id.required_if' => 'Curriculum is SHS, strand is required.',
        ]);
        
 
        foreach($req->section_subjects as $item){
            EnrolleeGrade::updateOrCreate([
                'academic_year_id' => $req->academic_year_id,
                'section_id' => $req->section_id,
                'subject_id' => $item['subject_id']
            ],[
                'academic_year_id' => $req->academic_year_id,
                'learner_id' => $req->learner_id,
                'grade_level' => $req->grade_level,
                'enroll_id' => $req->enroll_id,
                'section_id' => $req->section_id,
                'semester_id' => $req->curriculum == 'SHS' ? $req->semester_id : 0,
                'track_id' => $req->curriculum == 'SHS' ? $req->track_id : 0,
                'strand_id' => $req->curriculum == 'SHS' ? $req->strand_id : 0,
                'subject_id' => $item['subject_id'],
                'grade' => $item['grade']
            ]);
        }

        return $req;

        return response()->json([
            'status' => 'saved'
        ], 200);
    }

    
}

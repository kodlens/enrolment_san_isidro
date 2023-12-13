<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SectionSubject;

class SectionSubjectController extends Controller
{
    //

    public function index(){
        return view('administrator.section_subject.section-subject');
    }


    public function show($id){
    
    }


    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = SectionSubject::with(['section','subject'])
            ->whereHas('section', function($q)use($req){
                $q->where('section', 'like', $req->section . '%');
            })
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }

    public function create(){ 
        return view('administrator.section_subject.section-subject-create-edit')
            ->with('id', 0);
    }


    public function store(Request $req){
        $req->validate([
            //'academic_year_id' => ['required'],
            'grade_level' => ['required'],
            'section_id' => ['required'],
            'subjects' => ['required'],
            // 'semester_id' => ['required_if:grade_level.curriculum_code,SHS'],
            // 'track_id' => ['required_if:grade_level.curriculum_code,SHS'],
            // 'strand_id' => ['required_if:grade_level.curriculum_code,SHS'],
        ],[
            //'academic_year_id.required' => 'Please select academic year.',
            // 'semester_id.required_if' => 'Curriculum is SHS, semester is required.',
            // 'track_id.required_if' => 'Curriculum is SHS, track is required.',
            // 'strand_id.required_if' => 'Curriculum is SHS, strand is required.',

        ]);

        // $exist = SectionSubject::where('academic_year_id', $req->academic_year_id)
        //     ->where('section_id', $req->section_id)
        //     ->exists();

        // if($exist){
        //     return response()->json([
        //         'errors' => [
        //             'exist',
        //             'message' => ['Already had subjects.']
        //         ]
        //     ], 422);
        // }


        foreach($req->subjects as $item){
            SectionSubject::updateOrCreate([
                //'academic_year_id' => $req->academic_year_id,
                'section_id' => $req->section_id,
                'subject_id' => $item['subject_id']
            ],[
                //'academic_year_id' => $req->academic_year_id,
                'grade_level' => $req->grade_level['grade_level'],
                'section_id' => $req->section_id,
                // 'semester_id' => $req->grade_level['curriculum_code'] == 'SHS' ? $req->semester_id : 0,
                // 'track_id' => $req->grade_level['curriculum_code'] == 'SHS' ? $req->track_id : 0,
                // 'strand_id' => $req->grade_level['curriculum_code'] == 'SHS' ? $req->strand_id : 0,
                'subject_id' => $item['subject_id']
            ]);
        }
        

        return response()->json([
            'status' => 'saved'
        ], 200);
    }


    public function destroy($id){
        SectionSubject::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }
}

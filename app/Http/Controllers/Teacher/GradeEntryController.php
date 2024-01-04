<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\EnrollSubject;

class GradeEntryController extends Controller
{
    //

    public function index(Request $req){
        $ayId = $req->ay;
        $sectionId = $req->section;
        $enrollId = $req->enroll;
        $subjectId = $req->subject;

        return view('teacher.grade-entry')
            ->with('ayId', $ayId)
            ->with('sectionId', $sectionId)
            ->with('enrollId', $enrollId)
            ->with('subjectId', $subjectId);
    }

    public function getMyLearners(Request $req){

        $ayId = $req->academic;
        $sectionId = $req->section;
        $enrollId = $req->enroll;
        $subjectId = $req->subject;

        $students = DB::select('
            SELECT
            a.enroll_id, a.grade_level, a.section_id, e.section,
            a.strand_id, a.track_id, a.learner_id,
            a.semester_id,
            b.enroll_subject_id, b.subject_id,
            b.teacher_id,
            c.lname, c.fname, c.mname, c.sex,
            d.subject_id, d.subject_code, d.subject_description,
            b.grade
            FROM enrolls a
            JOIN enroll_subjects b ON a.enroll_id = b.enroll_id
            JOIN learners c ON a.learner_id = c.learner_id
            JOIN subjects d ON b.subject_id = d.subject_id
            JOIN sections e ON a.section_id = e.section_id
            WHERE b.subject_id = :subject_id AND a.academic_year_id = :academic_year_id
            AND a.section_id = :section_id
            ORDER BY c.lname ASC
        ', ['subject_id' => $subjectId, 'academic_year_id' => $ayId, 'section_id' => $sectionId]);


        return $students;
    }


    public function store(Request $req){


        $req->validate([
            'enroll_subject_id.*' => ['required'],
            'grade.*' => ['required']
        ]);
        $arrayData = $req->toArray();

        foreach($arrayData as $item){
            EnrollSubject::updateOrCreate([
                'enroll_subject_id' => $item['enroll_subject_id']
            ],[
                'grade'=> $item['grade']
            ]);
        }

        return response()->json([
            'status' => 'saved'
        ], 200);

    }
}

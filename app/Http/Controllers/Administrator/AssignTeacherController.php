<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EnrollSubject;


class AssignTeacherController extends Controller
{
    //


    public function index(){
        return view('administrator.assign-teacher.assign-teacher-index');
    }


    public function getData(Request $req){

        $sort = explode('.', $req->sort_by);
        
        $data = EnrollSubject::join('enrolls as b', 'enroll_subjects.enroll_id', 'b.enroll_id')
            ->join('academic_years as c', 'b.academic_year_id', 'c.academic_year_id')
            ->join('sections as d', 'b.section_id', 'd.section_id')
            ->join('subjects as e', 'enroll_subjects.subject_id', 'e.subject_id')
            ->leftjoin('tracks as f', 'b.track_id', 'f.track_id')
            ->leftjoin('strands as g', 'b.strand_id', 'g.strand_id')

            ->groupBy('b.section_id')
            ->groupBy('enroll_subjects.subject_id')
            ->where('b.academic_year_id', $req->ayid)
            ->where('b.grade_level', 'like',  $req->grade . '%')
            ->orderBy($sort[0], $sort[1])
            ->select('enroll_subject_id', 
                    'enroll_subjects.enroll_id', 
                    'enroll_subjects.subject_id', 
                    'e.subject_code',
                    'e.subject_description',
                    'teacher_id',
                    'c.academic_year_id', 
                    'c.academic_year_code',
                    'c.academic_year_desc',
                    'b.grade_level', 
                    'b.section_id',
                    'd.section',
                    'b.track_id',
                    'f.track',
                    'b.strand_id',
                    'g.strand'
                )
            ->paginate($req->perpage);

        return $data;
    }

}

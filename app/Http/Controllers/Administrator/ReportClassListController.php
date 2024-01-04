<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\EnrollSubject;

class ReportClassListController extends Controller
{
    //
    

    public function index(){
        return view('administrator.report.report-class-list');
    }


    public function getReportClassList(Request $req){

        return Section::with(['enrollees.learner', 
            'enrollees.subjects.subject',
            'enrollees.academic_year',
            'enrollees.track',
            'enrollees.strand',
            'enrollees.semester',
            'enrollees.grades'])
            ->get();
    }


    public function getReportClassListBySubject(Request $req){
        $ayId = $req->ayid;

        $data = EnrollSubject::join('enrolls as b', 'enroll_subjects.enroll_id', 'b.enroll_id')
            ->join('subjects', 'enroll_subjects.subject_id', 'subjects.subject_id')
            ->join('academic_years', 'b.academic_year_id', 'academic_years.academic_year_id')
            ->join('sections', 'b.section_id', 'sections.section_id')

            ->leftJoin('users', 'enroll_subjects.teacher_id', 'users.user_id')
            ->leftJoin('tracks', 'b.track_id', 'tracks.track_id')
            ->leftJoin('strands', 'b.strand_id', 'strands.strand_id')

            ->where('b.academic_year_id', $ayId)
            ->get();

        return $data;

    }
}

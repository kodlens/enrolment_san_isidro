<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\EnrollSubject;

class MySubjectController extends Controller
{
    //

    public function index(){
        return view('teacher.my-subject');
    }

    public function getData(Request $req){

        $user = Auth::user();

        $sort = explode('.', $req->sort_by);

        $data = EnrollSubject::join('enrolls', 'enroll_subjects.enroll_id', 'enrolls.enroll_id')
            ->join('subjects', 'enroll_subjects.subject_id', 'subjects.subject_id')
            ->join('sections', 'enrolls.section_id', 'sections.section_id')
            ->leftJoin('tracks', 'enrolls.track_id', 'tracks.track_id')
            ->leftJoin('strands', 'enrolls.strand_id', 'strands.strand_id')
            ->where('teacher_id', $user->user_id)
            ->where('academic_year_id', $req->academic)
            ->groupBy('enrolls.section_id')
            ->groupBy('enroll_subjects.subject_id')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;

    }
}

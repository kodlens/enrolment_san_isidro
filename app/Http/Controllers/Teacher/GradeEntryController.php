<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class GradeEntryController extends Controller
{
    //

    public function index(Request $req){

        // $results = DB::select('
        //     SELECT
        //     a.enroll_id, a.grade_level, a.section_id,
        //     a.strand_id, a.track_id, a.learner_id,
        //     a.semester_id,
        //     b.enroll_subject_id, b.subject_id,
        //     b.teacher_id,
        //     c.lname, c.fname, c.mname, c.sex,
        //     d.subject_id, d.subject_code, d.subject_description
        //     FROM enrolls a
        //     JOIN enroll_subjects b ON a.enroll_id = b.enroll_id
        //     JOIN learners c ON a.learner_id = c.learner_id
        //     JOIN subjects d ON b.subject_id = d.subject_id
        //     WHERE enroll = :user_id
        // ', ['user_id' => '']);

        return view('teacher.grade-entry');
    }

    public function getMyLearners(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = Subject::where('subject_description', 'like', $req->subject . '%')
            //->orderBy()
            ->paginate($req->perpage);

        return $data;
    }
}

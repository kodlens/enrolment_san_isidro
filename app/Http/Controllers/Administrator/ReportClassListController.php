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


    public function getReportClassListBySubjectTeacher(Request $req){
        $ayId = $req->ayid;

        $subjects = EnrollSubject::distinct('enrolls.section_id')
            ->join('enrolls', 'enroll_subjects.enroll_id', 'enrolls.enroll_id')
            ->join('subjects', 'enroll_subjects.subject_id', 'subjects.subject_id')
            ->join('sections', 'enrolls.section_id', 'sections.section_id')
            ->join('academic_years', 'enrolls.academic_year_id', 'academic_years.academic_year_id')
            ->leftJoin('tracks', 'enrolls.track_id', 'tracks.track_id')
            ->leftJoin('strands', 'enrolls.strand_id', 'strands.strand_id')
            ->leftJoin('users', 'enroll_subjects.teacher_id', 'users.user_id')

            ->where('enrolls.academic_year_id', $ayId)
            ->get(['enrolls.academic_year_id', 'academic_years.academic_year_code', 'academic_years.academic_year_desc', 
                'enroll_subjects.subject_id', 'subjects.subject_code', 'subjects.subject_description',
                'enrolls.section_id', 'sections.section', 
                'enrolls.grade_level', 'enrolls.track_id', 'tracks.track', 
                'enrolls.strand_id', 'strands.strand',
                'users.lname as teacher_lname', 'users.fname as teacher_fname', 'users.mname as teacher_mname', 'users.sex as teacher_sex'
                ]);

     
        $results = [];
        
        foreach($subjects as $subject){
            array_push($results, [
                'academic_year_id' => $subject['academic_year_id'],
                'academic_year_code' => $subject['academic_year_code'],
                'academic_year_desc' => $subject['academic_year_desc'],
                'subject_id' => $subject['subject_id'],
                'subject_code' => $subject['subject_code'],
                'subject_description' => $subject['subject_description'],
                'section_id' => $subject['section_id'],
                'section' => $subject['section'],
                'grade_level' => $subject['grade_level'],
                'track' => $subject['track'],
                'strand' => $subject['strand'],
                'teacher_lname' => $subject['teacher_lname'],
                'teacher_fname' => $subject['teacher_fname'],
                'teacher_mname' => $subject['teacher_mname'],
                'teacher_sex' => $subject['teacher_sex'],
            ]);
        }

        $finalResults = [];
        foreach($results as $res){
            $data = \DB::select('
                SELECT 
                c.lname,
                c.fname,
                c.mname,
                c.sex,
                c.contact_no
                FROM enroll_subjects a
                JOIN enrolls b ON a.enroll_id = b.enroll_id
                JOIN learners c ON b.learner_id = c.learner_id
                JOIN subjects d ON a.subject_id = d.subject_id
                JOIN sections e ON b.section_id = e.section_id
                WHERE b.academic_year_id = ?
                AND a.subject_id = ? AND b.section_id = ?
            ',[
                $res['academic_year_id'],
                $res['subject_id'],
                $res['section_id']
            ]);

            array_push($finalResults,[
                    'academic_year_id' => $res['academic_year_id'],
                    'academic_year_code' => $res['academic_year_code'],
                    'academic_year_desc' => $res['academic_year_desc'],
                    'subject_id' => $res['subject_id'],
                    'subject_code' => $res['subject_code'],
                    'subject_description' => $res['subject_description'],
                    'section_id' => $res['section_id'],
                    'section' => $res['section'],
                    'grade_level' => $res['grade_level'],
                    'track' => $res['track'],
                    'strand' => $res['strand'],
                    'teacher_lname' => $res['teacher_lname'],
                    'teacher_fname' => $res['teacher_fname'],
                    'teacher_mname' => $res['teacher_mname'],
                    'teacher_sex' => $res['teacher_sex'],
                    'students' => $data,
                    
                ]
            );
        }



        return $finalResults;

    }

    
}

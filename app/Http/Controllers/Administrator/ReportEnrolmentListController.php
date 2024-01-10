<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enroll;

class ReportEnrolmentListController extends Controller
{
    //

    public function index(){
        return view('administrator.report.report-enrolment-list');
    }


    public function getReportEnrolmentList(Request $req){
        $ayId =$req->academic;
        $gradeLevel =$req->grade;
        $sectionId =$req->section;

        $enrols = Enroll::with(['academic_year', 'section', 'track', 'strand', 'learner', 'learner.province', 'learner.city', 'learner.barangay'])
            ->where('academic_year_id', $ayId)
            ->where('grade_level', $gradeLevel)
            ->where('section_id', $sectionId)
            ->get();

        return $enrols;
    }
}

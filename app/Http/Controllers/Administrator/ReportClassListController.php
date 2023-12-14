<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;

class ReportClassListController extends Controller
{
    //
    

    public function index(){
        return view('administrator.report.report-class-list');
    }


    public function getReportClassList(Request $req){

        return Section::with(['enroll.learner', 
            'enroll.subjects.subject',
            'enroll.academic_year',
            'enroll.track',
            'enroll.strand',
            'enroll.semester',
            'enroll.grades'])
            ->get();
    }
}

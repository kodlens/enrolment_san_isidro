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

        return Section::with(['enrollees.learner', 
            'enrollees.subjects.subject',
            'enrollees.academic_year',
            'enrollees.track',
            'enrollees.strand',
            'enrollees.semester',
            'enrollees.grades'])
            ->get();
    }
}

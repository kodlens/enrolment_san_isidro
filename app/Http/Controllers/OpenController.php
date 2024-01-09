<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AcademicYear;
use App\Models\Semester;
use App\Models\Track;
use App\Models\Strand;
use App\Models\GradeLevel;
use App\Models\Section;
use App\Models\OtherFee;
use App\Models\Curriculum;
use App\Models\GradeLevelSubject;


class OpenController extends Controller
{
    //

    public function loadAcademicYears(){
        return AcademicYear::orderBy('academic_year_code', 'asc')
            ->get();
    }

    public function loadAcademicYear(){
        return AcademicYear::where('is_active', 1)
            ->first();
    }

    public function loadSemesters(){
        return Semester::orderBy('semester', 'asc')
            ->get();
    }

    public function loadTracks(){
        return Track::orderBy('track', 'asc')
            ->get();
    }

    public function loadStrands(Request $req){
        $trackId = $req->trackid;

        return Strand::where('track_id', $trackId)
            ->orderBy('strand', 'asc')
            ->get();
    }


    public function loadGradeLevels(){
        return GradeLevel::where('active', 1)
            ->orderBy('grade_level_id', 'asc')
            ->get();
    }

    public function loadSection(Request $req){
        $gradeLevel = $req->grade;

        return Section::where('grade_level', $gradeLevel)
            ->orderBy('section_id', 'asc')
            ->get();
    }

    public function loadOtherFees(){
        return OtherFee::orderBy('description', 'asc')
            ->get();
    }

    public function loadCurriculums(){
        return Curriculum::orderBy('curriculum_code', 'asc')
            ->get();
    }


    public function loadGradeLevelSubjects($grade){

        return GradeLevelSubject::with('subject')
            ->where('grade_level', $grade)
            ->get();
    }

    public function loadSubjectsBySemester($grade, $sem){

        return GradeLevelSubject::with('subject', 'semester')
            ->where('grade_level', $grade)
            ->where('semester_id', $sem)
            ->get();
    }


    

}

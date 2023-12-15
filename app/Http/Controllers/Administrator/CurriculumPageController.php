<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\GradeLevel;
use Illuminate\Http\Request;
use App\Models\Curriculum;

class CurriculumPageController extends Controller
{
    //

    public function index($id){

        $data = Curriculum::find($id);

        return view('administrator.curriculum.curriculum-page')
            ->with('id', $id)
            ->with('data', $data);
    }


    public function getGradeLevelSHS(Request $req){
        $sort = explode('.', $req->sort_by);

        return GradeLevel::where('curriculum_code', $req->code)
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

    }


}

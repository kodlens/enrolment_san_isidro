<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GradeLevel;
class GradeLevelController extends Controller
{
    //

    
    public function index(){
        return view('administrator.grade_level.grade-level-index');
    }


    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        return GradeLevel::where('grade_level', 'like', $req->grade . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);   
    }




    public function show($id){
        $data = GradeLevel::find($id);
        return $data;
    }

    public function store(Request $req){
        $req->validate([
            'grade_level' => ['required', 'unique:grade_levels'],
            'curriculum_code' => ['required']
        ]);

        GradeLevel::create([
            'grade_level' => strtoupper($req->grade_level),
            'curriculum_code' => strtoupper($req->curriculum_code),
            'active' => $req->active

        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }


    public function update(Request $req, $id){
       
        $req->validate([
            'grade_level' => ['required', 'unique:grade_levels,grade_level,' .$id.',grade_level_id'],
            'curriculum_code' => ['required']

        ]);

        $data = GradeLevel::find($id);
        $data->grade_level = strtoupper($req->grade_level);
        $data->curriculum_code = strtoupper($req->curriculum_code);
        $data->active = $req->active;

        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }



   

    public function destroy($id){
        GradeLevel::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }
}

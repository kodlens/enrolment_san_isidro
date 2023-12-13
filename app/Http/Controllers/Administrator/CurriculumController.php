<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculum;

class CurriculumController extends Controller
{
    //

    public function index(){
        return view('administrator.curriculum.curriculum-index');
    }


    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        return Curriculum::where('curriculum_description', 'like', $req->curriculum . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);   
    }




    public function show($id){
        $data = Curriculum::find($id);
        return $data;
    }

    public function store(Request $req){
        $req->validate([
            'curriculum_code' => ['required', 'unique:curriculums'],
            'curriculum_description' => ['required']
        ]);

        Curriculum::create([
            'curriculum_code' => strtoupper($req->curriculum_code),
            'curriculum_description' => strtoupper($req->curriculum_description)
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }


    public function update(Request $req, $id){
       
        $req->validate([
            'curriculum_code' => ['required', 'unique:curriculums,curriculum_code,' .$id.',curriculum_id'],
            'curriculum_description' => ['required']

        ]);

        $data = Curriculum::find($id);
        $data->curriculum_code = strtoupper($req->curriculum_code);
        $data->curriculum_description = strtoupper($req->curriculum_description);

        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }



   

    public function destroy($id){
        Curriculum::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }

}

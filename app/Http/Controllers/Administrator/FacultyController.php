<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;


class FacultyController extends Controller
{
    //

    public function index(){
        return view('administrator.faculty.faculty-index');
    }

    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = Faculty::where('lname', 'like', $req->name . '%')
            ->where('fname', 'like', $req->name . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }

    public function show($id){
        $data = Faculty::find($id);
        return $data;
    }


    public function store(Request $req){
        $req->validate([
            'lname' => ['required', 'string'],
            'fname' => ['required', 'string'],
            'sex' => ['required', 'string'],
        ]);

        Faculty::create([
            'lname' => strtoupper($req->lname),
            'fname' => strtoupper($req->fname),
            'mname' => strtoupper($req->mname),
            'sex' => strtoupper($req->sex)
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }


    public function update(Request $req, $id){
       
        $req->validate([
            'lname' => ['required', 'string'],
            'fname' => ['required', 'string'],
            'sex' => ['required', 'string'],
        ]);


        $data = Faculty::find($id);
        $data->lname = strtoupper($req->lname);
        $data->fname = strtoupper($req->fname);
        $data->mname = strtoupper($req->mname);
        $data->sex = strtoupper($req->sex);
        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }





    public function destroy($id){
        Faculty::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }
}

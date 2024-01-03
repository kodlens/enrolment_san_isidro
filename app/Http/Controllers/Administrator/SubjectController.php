<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //

    public function index(){
        return view('administrator.subject.subject-page');
    }

    public function show($id){
        return Subject::find($id);
    }
    public function getSubjects(Request $req){

        $sort = explode('.', $req->sort_by);

        $data = Subject::where('subject_description', 'like', $req->subject . '%')
            ->orWhere('subject_code', 'like', $req->subject . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }

    public function store(Request $req){
        $req->validate([
            'subject_code' => ['required','unique:subjects'],
            'subject_description' => ['required']
        ]);

        Subject::create([
            'subject_code' => strtoupper($req->subject_code),
            'subject_description' => strtoupper($req->subject_description),
            'units' => strtoupper($req->units),
            'fee' => $req->fee,
            'class' => strtoupper($req->class)
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }



    public function update(Request $req, $id){

        $req->validate([
            'subject_code' => ['required', 'unique:subjects,subject_code,' . $id . ',subject_id'],
            'subject_description' => ['required']
        ]);

        $data = Subject::find($id);
        $data->subject_code = strtoupper($req->subject_code);
        $data->subject_description = strtoupper($req->subject_description);
        $data->units = strtoupper($req->units);
        $data->fee = strtoupper($req->fee);
        $data->class = strtoupper($req->class);

        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }


    public function destroy($id){
        Subject::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }



    //browse
    public function getBrowseSubjects(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = Subject::where('subject_code', 'like', $req->code . '%')
            ->where('subject_description', 'like', $req->desc . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;

    }



}

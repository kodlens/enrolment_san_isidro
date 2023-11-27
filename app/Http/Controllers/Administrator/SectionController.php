<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;


class SectionController extends Controller
{
    //

    public function index(){
        return view('administrator.section.section');
    }


    public function show($id){
        return Section::with(['track', 'strand'])
            ->find($id);
    }


    public function getSections(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = Section::with(['track', 'strand'])
            ->where('section', 'like', $req->section . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }

    public function store(Request $req){

        $req->validate([
            'section' => ['required', 'unique:sections']
        ]);

        Section::create([
            'section' => strtoupper($req->section),
            'max' => $req->max,
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);

    }

    public function update(Request $req, $id){

        $req->validate([
            'section' => ['required', 'unique:sections,section,' . $id . ',section_id'],
        ]);

        Section::where('section_id', $id)
            ->update([
                'section' => strtoupper($req->section),
                'max' => $req->max
            ]);

        return response()->json([
            'status' => 'updated'
        ], 200);
    }


    public function destroy($id){
        Section::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }
}

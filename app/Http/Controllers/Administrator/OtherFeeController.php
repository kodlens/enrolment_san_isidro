<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OtherFee;

class OtherFeeController extends Controller
{
    //

    
    public function index(){
        return view('administrator.other-fee');
    }

    public function getData(Request $req){

        $sort = explode('.', $req->sort_by);

        $data = OtherFee::where('description', 'like', $req->description . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }

    public function show($id){
        $data = OtherFee::find($id);
        return $data;
    }

    public function store(Request $req){
        $req->validate([
            'description' => ['required', 'unique:other_fees'],
            'amount' => ['required'],
        ]);

        OtherFee::create([
            'description' => strtoupper($req->description),
            'amount' => strtoupper($req->amount),
            'is_active' => $req->is_active
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }


    public function update(Request $req, $id){
       
        $req->validate([
            'description' => ['required', 'unique:other_fees,description,' .$id.',other_fee_id'],
            'amount' => ['required']

        ]);

        $data = OtherFee::find($id);
        $data->description = strtoupper($req->description);
        $data->amount = strtoupper($req->amount);
        $data->is_active = $req->is_active;

        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }



    public function active($id){
        // AcademicYear::where('is_active', 1)
        //     ->update(['is_active' => 0]);
 
        $data = OtherFee::find($id);
        $data->is_active = 1;
        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }

    public function deactive($id){
        // AcademicYear::where('is_active', 1)
        //     ->update(['is_active' => 0]);
 
        $data = OtherFee::find($id);
        $data->is_active = 0;
        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }


    public function destroy($id){
        OtherFee::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }


}

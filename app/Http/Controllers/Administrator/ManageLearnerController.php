<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Learner;
use Illuminate\Validation\Rule;
use App\Models\AcademicYear;




class ManageLearnerController extends Controller
{
    //


    public function index(){
        return view('administrator.manage-learner.manage-learner');
    }


    public function getLearners(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = Learner::with(['track', 'strand'])
            ->where('lname', 'like', $req->lname . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }

    public function create(){
        return view('administrator.manage-learner.manage-learner-create-edit')
            ->with('id', 0)
            ->with('data', '');
    }

    public function edit($id){

        $data = Learner::with([
            'grade_level',
            'province', 
            'city',
            'barangay',
            'track', 
            'strand'])
            ->where('learner_id', $id)
            ->first();

        return view('administrator.manage-learner.manage-learner-create-edit')
            ->with('id', $data->learner_id)
            ->with('data', $data);
    }


    public function store(Request $req){
       
  
        $req->validate([

            'grade_level' => ['required'],
            'learner_status' => ['required'],

            'lname' => ['required', 'string', 'max:50'],
            'fname' => ['required', 'string', 'max:50'],
            'sex' => ['required', 'string', 'max:10'],
            'birthdate' => ['required'],
            
            'age' => ['required'],

            'province' => ['required'],
            'city' => ['required'],
            'barangay' => ['required'],
            'zipcode' => ['max:15'],

            'guardian_lname' => ['required'],
            'guardian_fname' => ['required'],
            'guardian_contact_no' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            'semester_id' => ['required_if:grade_level.curriculum_code,SHS'],
            'track_id' => ['required_if:grade_level.curriculum_code,SHS'],
            'strand_id' => ['required_if:grade_level.curriculum_code,SHS'],

        ],[
            'guardian_contact_no.regex' => 'Please enter a valid Philippines mobile phone number.',
            //'if_yes_indigenous.required' => 'This field is required since you belong to indigenous.',
            //'household_4ps_id_no.required' => 'This field is required since you are a 4ps member.',

            'semester_id.required_if' => 'Curriculum is SHS, semester is required.',
            'track_id.required_if' => 'Curriculum is SHS, track is required.',
            'strand_id.required_if' => 'Curriculum is SHS, strand is required.',
            
            
            // 'last_grade_level_completed.required' => 'This field is required since you are a returnee student.',
            // 'last_school_year_completed.required' => 'This field is required since you are a returnee student.',
            // 'last_school_attended.required' => 'This field is required since you are a returnee student.',
            // 'last_schoold_id.required' => 'This field is required since you are a returnee student.'

        ]);


        $ay = AcademicYear::where('is_active', 1)->first();

        /*inserting data to database*/
        $data = Learner::create([

            'academic_year_id' => $ay->academic_year_id,
            'grade_level' => $req->grade_level['grade_level'],
            'learner_status' => $req->learner_status,

            'lrn' => $req->lrn,
            'lname' => strtoupper($req->lname),
            'fname' => strtoupper($req->fname),
            'mname' => strtoupper($req->mname),
            'extension' => strtoupper($req->suffix),
            'sex' => $req->sex,
            'birthdate' => date('Y-m-d', strtotime($req->formatted_bdate)),
            'age' => $req->age,
            'birthplace' => strtoupper($req->birthplace),
            'last_school_attended' => strtoupper($req->last_school_attended),

            'province' => $req->province,
            'city' => $req->city,
            'barangay' => $req->barangay,
            'street' => strtoupper($req->street),
            'zipcode' => $req->zipcode,
            'religion' => $req->religion,
            'email' => $req->email,
            'contact_no' => $req->contact_no,

            'father_lname' => strtoupper($req->father_lname),
            'father_fname' => strtoupper($req->father_fname),
            'father_mname' => strtoupper($req->father_mname),
            'father_extension' => strtoupper($req->father_extension),
            'father_contact_no' => $req->father_contact_no,
            'father_education' => strtoupper($req->father_education),
            'father_religion' => strtoupper($req->father_religion),

            'mother_maiden_lname' => strtoupper($req->mother_maiden_lname),
            'mother_maiden_fname' => strtoupper($req->mother_maiden_fname),
            'mother_maiden_mname' => strtoupper($req->mother_maiden_mname),
            'mother_maiden_contact_no' => $req->mother_maiden_contact_no,
            'mother_education' => strtoupper($req->mother_education),
            'mother_religion' => strtoupper($req->mother_religion),


            'guardian_lname' => strtoupper($req->guardian_lname),
            'guardian_fname' => strtoupper($req->guardian_fname),
            'guardian_mname' => strtoupper($req->guardian_mname),
            'guardian_extension' => strtoupper($req->guardian_mname),
            'guardian_contact_no' => $req->guardian_contact_no,
            'guardian_relationship' => $req->guardian_relationship,

            'semester_id' => $req->grade_level['curriculum_code'] == 'SHS' ? $req->semester_id : null,
            'track_id' => $req->grade_level['curriculum_code'] == 'SHS' ? $req->track_id : null,
            'strand_id' => $req->grade_level['curriculum_code'] == 'SHS' ? $req->strand_id : null,

        ]);

        $updateData = Learner::find($data->learner_id);
        $id = date('Y') . '-' . str_pad($data->learner_id, 6, '0', STR_PAD_LEFT);
        $updateData->student_id = $id;
        $updateData->save();

        return response()->json([
            'status' => 'saved'
        ], 200);
    }

    
    public function update(Request $req, $id){

        $req->validate([

            'grade_level' => ['required'],
            'learner_status' => ['required'],

            'lname' => ['required', 'string', 'max:50'],
            'fname' => ['required', 'string', 'max:50'],
            'sex' => ['required', 'string', 'max:10'],
            'birthdate' => ['required'],
            
            'age' => ['required'],

            'province' => ['required'],
            'city' => ['required'],
            'barangay' => ['required'],
            'zipcode' => ['max:15'],

            'guardian_lname' => ['required'],
            'guardian_fname' => ['required'],
            'guardian_contact_no' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            'semester_id' => ['required_if:grade_level.curriculum_code,SHS'],
            'track_id' => ['required_if:grade_level.curriculum_code,SHS'],
            'strand_id' => ['required_if:grade_level.curriculum_code,SHS'],

        ],[
            'guardian_contact_no.regex' => 'Please enter a valid Philippines mobile phone number.',
            //'if_yes_indigenous.required' => 'This field is required since you belong to indigenous.',
            //'household_4ps_id_no.required' => 'This field is required since you are a 4ps member.',

            'semester_id.required_if' => 'Curriculum is SHS, semester is required.',
            'track_id.required_if' => 'Curriculum is SHS, track is required.',
            'strand_id.required_if' => 'Curriculum is SHS, strand is required.',
            
            
            // 'last_grade_level_completed.required' => 'This field is required since you are a returnee student.',
            // 'last_school_year_completed.required' => 'This field is required since you are a returnee student.',
            // 'last_school_attended.required' => 'This field is required since you are a returnee student.',
            // 'last_schoold_id.required' => 'This field is required since you are a returnee student.'

        ]);
        /* if not a senior high, set default value */
        /*inserting data to database*/
        $data = Learner::where('learner_id', $id)
            ->update([

                'grade_level' => $req->grade_level['grade_level'],
                //'is_returnee' => $req->is_returnee,

                //'psa_cert' => $req->psa_cert,
                'lrn' => $req->lrn,
                'lname' => strtoupper($req->lname),
                'fname' => strtoupper($req->fname),
                'mname' => strtoupper($req->mname),
                'extension' => strtoupper($req->suffix),
                'sex' => $req->sex,
                'birthdate' => date('Y-m-d', strtotime($req->birthdate)),
                'age' => $req->age,
                'birthplace' => strtoupper($req->birthplace),

   
                'province' => $req->province,
                'city' => $req->city,
                'barangay' => $req->barangay,
                'street' => strtoupper($req->street),
                'zipcode' => $req->zipcode,

                // 'permanent_province' => $req->permanent_province,
                // 'permanent_city' => $req->permanent_city,
                // 'permanent_barangay' => $req->permanent_barangay,
                // 'permanent_street' => strtoupper($req->permanent_street),
                // 'permanent_zipcode' => $req->permanent_zipcode,

                //'email' => $req->email,
                //'contact_no' => $req->contact_no,

                'father_lname' => strtoupper($req->father_lname),
                'father_fname' => strtoupper($req->father_fname),
                'father_mname' => strtoupper($req->father_mname),
                'father_extension' => strtoupper($req->father_mname),
                'father_contact_no' => $req->father_contact_no,

                'mother_maiden_lname' => strtoupper($req->mother_maiden_lname),
                'mother_maiden_fname' => strtoupper($req->mother_maiden_fname),
                'mother_maiden_mname' => strtoupper($req->mother_maiden_mname),
                'mother_maiden_contact_no' => $req->mother_maiden_contact_no,

                'guardian_lname' => strtoupper($req->guardian_lname),
                'guardian_fname' => strtoupper($req->guardian_fname),
                'guardian_mname' => strtoupper($req->guardian_mname),
                'guardian_extension' => strtoupper($req->guardian_mname),
                'guardian_contact_no' => $req->guardian_contact_no,

                // 'last_grade_level_completed' => $lastGradeLevelCompleted,
                // 'last_school_year_completed' => $lastSchoolYearCompleted,
                // 'last_school_attended' => $lastSchoolAttended,
                //'last_schoold_id' => $lastSchoolId,

                'semester_id' => $req->grade_level['curriculum_code'] == 'SHS' ? $req->semester_id : null,
                'track_id' => $req->grade_level['curriculum_code'] == 'SHS' ? $req->track_id : null,
                'strand_id' => $req->grade_level['curriculum_code'] == 'SHS' ? $req->strand_id : null,
            ]);

        return response()->json([
            'status' => 'updated'
        ],200);
    }




    //for modal browse
    public function getBrowseLearners(Request $req){
        $sort = explode('.', $req->sort_by);
        $ayId = $req->ayid;
        $studentId = $req->student;

        $learners = Learner::with(['track', 'strand', 'grade_level', 'section', 'semester'])
            //->where('academic_year_id', $ayId)
            ->where('student_id', 'like', $studentId . '%')
            ->where('lname', 'like', $req->lname . '%')
            ->where('fname', 'like', $req->fname . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $learners;

    }


    public function destroy($id){
        Learner::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }


}

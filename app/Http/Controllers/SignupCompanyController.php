<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignupCompanyController extends Controller
{
    //




    public function store(Request $req){

        $validate = $req->validate([
            'company' => ['required', 'string', 'max: 100'],
            'owner' => ['required'],
            'company_logo' => ['required', 'mimes:jpg,png,bmp'],
        ], $message = [
            'bhouse_img_path.mimes' => 'Type of the file must be jpg, png or bmp.',
            'bhouse_img_path.required' => 'Image is required.'
        ]);
       
        $company_logo = null;
        //upload image b house
        $company_logo = $req->file('company_logo');
        if($bhouseImg){
            $pathFile = $company_logo->store('public/company'); //get path of the file
            $companyLogoPath = explode('/', $pathFile); //split into array using /
        }

        Company::create([
            'company' => strtoupper($req->company),
            'owner' => strtoupper($req->owner),
            'history' => $req->history,
            'overview' => $req->overview,
            'company_size' => $req->company_size,
            
            'industry' => $req->industry,
            'benefits_others' => $req->benefits_others,


            'phone_contact' => $req->phone_contact,
            'fb_contact' => $req->fb_contact,
            'twitter_contact' => $req->twitter_contact,
            'insta_contact' => $req->insta_contact,
            'viber_contact' => $req->viber_contact,
            'whatsapp_contact' => $req->whatsapp_contact,
            
            'desc' => $req->desc,

            'province' => $req->province,
            'city' => $req->city,
            'barangay' => $req->barangay,
            'street' => $req->street,

            'company_logo' => $companyLogoPath[2] != null ? $companyLogoPath[2]: '',
        ]);
    }

}

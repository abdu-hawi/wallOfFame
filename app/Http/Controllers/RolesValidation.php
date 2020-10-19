<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RolesValidation{

    public function quotationPrice(){
        return [
            'model_id'=>"sometimes|nullable|numeric",
            'img_cover'=>"sometimes|nullable|string",
            "model_nickname"=>"sometimes|nullable|string",//regex:^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$^",
            'company_id'=>"sometimes|nullable|numeric",
            "company_name"=>"sometimes|nullable|string",//regex:^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$^",
            "title"=>"required|string",//regex:^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$^",
            "description"=>"required|string",//regex:^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$^",
            "date"=>"required",
            "country"=>"required",
            "city"=>"required",
            "time"=>"sometimes|nullable",
            "price"=>"sometimes|nullable|numeric",
//            "status"=>"sometimes|nullable|numeric|in:0,1,2,3,4,5",
            "explain_status"=>"sometimes|nullable|string",//regex:^[a-zA-Z0-9_:]+( [a-zA-Z0-9_:]+)*$^",
        ];
    }

    public function updateAccount(){
        return [
            'gm_name'=>'required|regex:^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$^',
            'email'=>'required|email|unique:companies,email,'.Auth::id(),
            'phone'=>'required|numeric|unique:companies,phone,'.Auth::id(),
        ];
    }

    public function modelsProfile(){
        return [
            'img_cover' => 'required',
            'full_name' => 'required|regex:^[a-zA-Z_]+( [a-zA-Z_]+)*$^',
            'email'=>'required|email|unique:model_profiles,email,'.Auth::id(),
            'nick_name' => 'required|regex:^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$^',
            'age' => 'required|numeric|max:99',
            'length' => 'required|numeric|min:10|max:250',
            'weight' => 'required|numeric|min:10|max:350',
            'nationality' => 'required|regex:^[a-zA-Z_]+( [a-zA-Z_]+)*$^',
            'start_work' => 'required|regex:^[0-9_\:]*$^',
            'end_work' => 'required|regex:^[0-9_\:]*$^',
            'iban'=>'required|numeric',
            'bank_name'=>'required|regex:^[a-zA-Z]+( [a-zA-Z]+)*$^',
            'owner_name'=>'required|regex:^[a-zA-Z]+( [a-zA-Z]+)*$^',
            "city_id" => 'required|numeric',
            'img_profile.*'=>'sometimes|nullable|array|max:3',
            'img_profile.0'=>'',
            'img_profile.1'=>'',
            'img_profile.2'=>'',
        ];
    }

    public function saveCard(){
        return [
            'type' => 'required|in:visa,mada',
            'owner' => 'required|regex:^[a-zA-Z_]+( [a-zA-Z_]+)*$^',
            'number' => 'required|numeric',//|max:16',
            'ccv' => 'required|numeric',//|max:3',
            'expDate' => 'required|regex:^[0-9_\:]*$^',
        ];
    }
}

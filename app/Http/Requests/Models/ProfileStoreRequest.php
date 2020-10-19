<?php

namespace App\Http\Requests\Models;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Redirector;

class ProfileStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'img_cover' => 'required',
            'full_name' => 'required|regex:^[a-zA-Z_]+( [a-zA-Z_]+)*$^',
            'email'=>'required|email|unique:model_profiles',
            'nick_name' => 'required|regex:^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$^',
            'age' => 'required|numeric|max:99',
            'length' => 'required|numeric|min:10|max:250',
            'weight' => 'required|numeric|min:10|max:350',
            'nationality' => 'required|regex:^[a-zA-Z_]+( [a-zA-Z_]+)*$^',
            'start_work' => 'required|regex:^[0-9_\:]*$^',
            'end_work' => 'required|regex:^[0-9_\:]*$^',
            'img_profile.*'=>'sometimes|nullable|array|max:3',
            'img_profile.0'=>'',
            'img_profile.1'=>'',
            'img_profile.2'=>'',
        ];
    }

    public function messages()
    {
        return [
            'img_cover' => trans('model.Image cover'),
            'full_name' => trans('model.Full name'),
            'nick_name' => trans('model.Nickname'),
            'age' => trans('model.Age'),
            'length' => trans('model.Length'),
            'weight' => trans('model.Weight'),
            'nationality' => trans('model.Nationality'),
            'start_work' => trans('model.Start work'),
            'end_work' => trans('model.End work'),
            'img_profile' => trans('model.Image profile'),
        ];
    }


}

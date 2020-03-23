<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePersonalDataPost extends FormRequest
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
    public function rules()
    {
        if(auth()->user()->role_id == 3){
        return [
            'first_name' => 'required|alpha|max:255',
            'last_name' => 'required|alpha|max:255',
            'occupation'=> 'required|string|max:255',
            'mobile' => 'required|numeric|unique:users,mobile,'.auth()->user()->id,
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'birth_date'=>'required|date',
            'gender_id'=>'required',
            'country_id'=> 'required',
            'pain_id'=>'required'
        ];
            }
        elseif (auth()->user()->role_id == 2) {
        return [
            'first_name' => 'required|alpha|max:255',
            'last_name' => 'required|alpha|max:255',
            'occupation'=> 'required|string|max:255',
            'mobile' => 'required|numeric|unique:users,mobile,'.auth()->user()->id,
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'birth_date'=>'required|date',
            'gender_id'=>'required',
            'country_id'=> 'required',
            'specialty_id'=>'required'
        ];
        }
        else{
        return [
            'first_name' => 'required|alpha|max:255',
            'last_name' => 'required|alpha|max:255',
            'occupation'=> 'required|string|max:255',
            'mobile' => 'required|numeric|unique:users,mobile,'.auth()->user()->id,
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'birth_date'=>'required|date',
            'gender_id'=>'required',
            'country_id'=> 'required',
        ];
        }
    }
}

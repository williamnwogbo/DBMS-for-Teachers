<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTeachers extends FormRequest
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
        return [
            'tsc_file_no' => 'required',
            'og_file_no' => 'required',
            'phone_no' => 'required',
            'professional_status' => 'required',
            'email' => 'required'
        ];
    }
}

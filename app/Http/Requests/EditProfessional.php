<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfessional extends FormRequest
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
            'qualification' => 'required',
            'year' => 'required',
            'subject_of_specialisation' => 'required',
            'classifications' => 'required',
            'post_held' => 'required',
            'appointment' => 'required',
            'last_promotion' => 'required'
        ];
    }
}

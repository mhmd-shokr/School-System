<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "Name_ar"=>"required|string|unique:grades,Name->ar",
            "Name_en"=>"required|string|unique:grades,Name->en",
            "Notes"=>"nullable|string|max:255",
        ];
    }

    public function messages()
    {
        return [
            'Name_ar.required' => trans('validation.required'),
            'Name_ar.string'   => trans('validation.string'),
            'Name_ar.unique'   => trans('validation.unique'),

            'Name_en.required' => trans('validation.required'),
            'Name_en.string'   => trans('validation.string'),
            'Name_en.unique'   => trans('validation.unique'),

            'Notes.string'     => trans('validation.string'),
            'Notes.max'        => trans('validation.max.string', ['max' => 255]),

        ];
    }
    
}

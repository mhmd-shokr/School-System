<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
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
            "Name_Section_Ar" => "sometimes|string|max:50",
            "Name_Section_En" => "sometimes|string|max:50",

            "Grade_id" => "sometimes|exists:grades,id",
            "Class_id" => "sometimes|exists:classrooms,id",

        ];
    }

    public function messages(): array
    {
        return [
            "Name_Section_Ar.string" => trans('validation.string'),
            "Name_Section_Ar.max"    => trans('validation.max.string'),
    
            "Name_Section_En.string" => trans('validation.string'),
            "Name_Section_En.max"    => trans('validation.max.string'),
    
            "Grade_id.exists"        => trans('validation.exists'),
            "Class_id.exists"        => trans('validation.exists'),
        ];
    }
}

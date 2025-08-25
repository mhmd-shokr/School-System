<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
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
            "Name_Section_Ar" => "required|string|max:50",
            "Name_Section_En" => "required|string|max:50",

            "Grade_id" => "required|exists:grades,id",
            "Class_id" => "required|exists:classrooms,id",

        ];
    }

    public function messages(): array
    {
        return [
            "Name_Section_Ar.required" => trans('validation.required', ['attribute' => trans('section.name_ar')]),
            "Name_Section_En.required" => trans('validation.required', ['attribute' => trans('section.name_en')]),
            "Grade_id.required"        => trans('validation.required', ['attribute' => trans('section.grade')]),
            "Class_id.required"        => trans('validation.required', ['attribute' => trans('section.class')]),
        ];
    }
    
}

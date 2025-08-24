<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassesromRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

        public function rules(): array
        {
            return [
                "List_Classes.*.Name" => 'sometimes|string|max:255|unique:classrooms,Name_class,' . $this->classroom->id,
                "List_Classes.*.Name_class_en" => 'sometimes|string|max:255|unique:classrooms,Name_class,' . $this->classroom->id,

                "List_Classes.*.Grade_id"      => 'sometimes|exists:grades,id',
            ];
        }
        public function messages()
        {
            return [
                'List_Classes.*.Name.string'            => trans('validation.string'),
                'List_Classes.*.Name.max'               => trans('validation.max.string', ['max' => 255]),
                'List_Classes.*.Name.unique'            => trans('validation.unique'),

                'List_Classes.*.Name_class_en.string'   => trans('validation.string'),
                'List_Classes.*.Name_class_en.max'      => trans('validation.max.string', ['max' => 255]),
                'List_Classes.*.Name_class_en.unique'   => trans('validation.unique'),
    
                'List_Classes.*.Grade_id.exists'        => trans('validation.exists'),
    
            ];
        }
    }
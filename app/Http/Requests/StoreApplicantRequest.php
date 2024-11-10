<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicantRequest extends FormRequest
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
            'full_name' => 'required|string',
            'email' => 'required|email|unique:applicants',
            'phone_number' => 'required|string',
            'education' => 'required|array',
            'education.*.institution' => 'required|string',
            'education.*.degree' => 'required|string',
            'education.*.year' => 'required|integer',
            // 'work_experience' => 'required|array',
            'work_experience.*.company' => 'string',
            'work_experience.*.role' => 'string',
            'work_experience.*.start_date' => 'date',
            'work_experience.*.end_date' => 'date',
            // 'skills' => 'array',
            'skills.*' => 'string',


        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'Full name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email already exists',
            'phone_number.required' => 'Phone number is required',
            'education.required' => 'Education history is required',
            'education.*.institution.required' => 'Institution is required',
            'education.*.degree.required' => 'Degree is required',
            'education.*.year.required' => 'Year is required',
            'education.*.year.integer' => 'Year must be an integer',
            // 'work_experience.required' => 'Work experience is required',
            'work_experience.*.company.string' => 'Company must be a string',
            'work_experience.*.role.string' => 'Role must be a string',
            'work_experience.*.start_date.date' => 'Start date must be a date',
            'work_experience.*.end_date.date' => 'End date must be a date',
            // 'skills.array' => 'Skills must be an array',
            'skills.*.string' => 'Skill must be a string',
        ];
    }
}
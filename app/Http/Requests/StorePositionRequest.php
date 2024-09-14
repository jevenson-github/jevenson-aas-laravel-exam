<?php

namespace App\Http\Requests;

use App\Rules\ValidReportsTo;
use Illuminate\Foundation\Http\FormRequest;

class StorePositionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Check authorization
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */ 

    // Rules for validation 
    public function rules(): array
    {
        return [
            'position_name' => [
                'required',
                'string',
                'max:255',
                'unique:positions',
                // Rule::unique()->ignore($this->id)
            ],
            'reports_to_id' => [
                new ValidReportsTo
            ]
        ];
    }
 

    // Message holder 
    public function attributes () {
        return [
            'position_name' => 'Position Name',
            'reports_to_id' => 'Reports To'
        ];
    }
    
    // Custom Message 
    public function messages () {
        return [
            'position_name' => [
                'required' => 'The :attribute is required.',
                'string' => 'The :attribute must be a string.',
                'unique' => 'The :attribute already exists.'
            ],
        ];
    }
}

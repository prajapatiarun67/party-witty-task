<?php

namespace App\Http\Requests\consumer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updateConsumer extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:150',
            'email' => [ 
                    'required', 
                    'string',
                    'max:50',
                    Rule::unique('consumers', 'email')->ignore($this->consumer, 'id')
                ],
            'contact_info' => 'required|string|max:20',
            'type' => 'required',
        ];
    }
}

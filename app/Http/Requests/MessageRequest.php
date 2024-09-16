<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'message' => 'required|string',
            'recipient' => 'required|string|max:255',
            'expires_at' => 'nullable|date|after:today',
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'Message is required.',
            'recipient.required' => 'Recipient is required.',
            'expires_at.after' => 'Expiry date must be a future date.',
        ];
    }
}

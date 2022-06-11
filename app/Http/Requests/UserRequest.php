<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $required = $this->route('user') ? "nullable" : "required";

        return [
            'name' => 'required|min:3|max:100',
            'login' => 'required|min:3|max:100|email',
            'password' => "{$required}|min:6|max:18"
        ];
    }
}

<?php

namespace App\Http\Requests\Admin\Moderator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'surname' => 'required|string',
            'username' => ['required', 'string', Rule::unique('users', 'username')->ignore($this->moderator->user_id)],
            'date_of_birth' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required|string',
            'password' => 'nullable|confirmed|min:6',
        ];
    }
}

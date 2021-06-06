<?php

namespace App\Http\Requests\Admin\Customer;

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
            'username' => ['required', 'string', Rule::unique('users', 'username')->ignore($this->customer->user_id)],
            'date_of_birth' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required|string',
            'is_active' => 'required|boolean',
            'password' => 'nullable|confirmed|min:6',
        ];
    }
}

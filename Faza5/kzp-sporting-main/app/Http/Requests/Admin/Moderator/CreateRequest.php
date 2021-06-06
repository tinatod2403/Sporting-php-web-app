<?php

namespace App\Http\Requests\Admin\Moderator;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'username' => 'required|string|unique:users,username',
            'date_of_birth' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required|string',
            'password' => 'required|confirmed|min:6',
        ];
    }
}

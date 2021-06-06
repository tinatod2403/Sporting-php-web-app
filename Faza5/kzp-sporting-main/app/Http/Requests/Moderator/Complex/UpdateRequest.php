<?php

namespace App\Http\Requests\Moderator\Complex;

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
        return auth()->guard('moderator')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique('complexes', 'name')->ignore($this->complex->id)],
            'content' => 'required|string',
            'categories' => 'required|array|min:1',
            'logo' => 'nullable|image',
            'images' => 'nullable|array|size:3',
            'images.*' => 'image',
        ];
    }
}

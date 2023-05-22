<?php

namespace App\Http\Requests\Profile;

use App\Rules\CheckPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'current_password' => ['nullable', Rule::requiredIf(isset($this->password)), new CheckPassword],
            'password' => ['nullable', Rule::requiredIf(isset($this->current_password)), 'string', 'confirmed', Password::min(8)],
        ];
    }
}

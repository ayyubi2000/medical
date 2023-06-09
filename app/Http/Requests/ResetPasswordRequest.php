<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        //        return Auth::check();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'numeric'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5'],
        ];
    }
}
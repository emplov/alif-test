<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $route = $this->route()->getName();

        $rules = [
            'email.store' => [
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    'unique:emails,email',
                ],
            ],
            'email.update' => [
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    'unique:emails,email,' . $this->route()->parameter('email_id'),
                ],
            ],
        ];

        return $rules[$route];
    }
}

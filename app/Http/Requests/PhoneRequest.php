<?php

namespace App\Http\Requests;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class PhoneRequest extends FormRequest
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
            'phone.store' => [
                'phone' => [
                    'required',
                    'max:255',
                    new Phone,
                    'unique:phones,phone',
                ],
            ],
            'phone.update' => [
                'phone' => [
                    'required',
                    'max:255',
                    new Phone,
                    'unique:phones,phone,' . $this->route()->parameter('phone_id'),
                ],
            ],
        ];

        return $rules[$route];
    }
}

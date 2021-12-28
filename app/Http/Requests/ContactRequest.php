<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'contacts.store' => [
                'name' => [
                    'required',
                    'max:255',
                    'unique:contacts,name'
                ],
            ],

            'contacts.update' => [
                'name' => [
                    'required',
                    'max:255',
                    'unique:contacts,name,' . $this->route()->parameter('contact'),
                ],
            ],
        ];

        return $rules[$route];
    }
}

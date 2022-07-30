<?php

namespace App\Http\Requests\Admin;

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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            case 'POST':
            {
                return [
                    'name' => 'required|string|min:2',
                    'email' => 'required|string|email|unique:users,email',
                    'phone_number' => 'required|string|unique:users,phone_number',
                    'role' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|string|min:2',
                    'email' => 'required|string|email|unique:users,email,' . $this->email . ',email',
                    'phone_number' => 'required|string|unique:users,phone_number,' . $this->phone_number .',phone_number',
                    'role' => 'required',
                ];
            }
            default:break;
        }
    }
}

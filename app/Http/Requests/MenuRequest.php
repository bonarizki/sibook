<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
                    'menu_name' => 'required|string|min:3',
                    'category_id' => 'required|numeric|exists:categories,id',
                    'price' => 'required|string',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'menu_name' => 'required|string|min:3',
                    'category_id' => 'required|numeric|exists:categories,id',
                    'price' => 'required|string',
                ];
            }
            default:break;
        }
    }
}

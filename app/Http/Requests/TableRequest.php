<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableRequest extends FormRequest
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
                    'table_name' => 'required|string|min:3',
                    'table_code' => 'required|string|unique:tables,table_code',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'table_name' => 'required|string|min:3',
                    'table_code' => 'required|string|unique:tables,table_code,'.$this->table_code.',table_code',
                ];
            }
            default:break;
        }
    }
}

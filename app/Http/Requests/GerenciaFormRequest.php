<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GerenciaFormRequest extends FormRequest
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
        return [
            'nombre'=>'required',
            'user_id'=>'required|unique:areas, user_id'

        ];
    }
}

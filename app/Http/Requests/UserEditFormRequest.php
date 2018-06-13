<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Route;

class UserEditFormRequest extends FormRequest
{
    /**
     * UserEditFormRequest constructor.
     */
    public function __construct (Route $route)
    {
        $this->route = $route;
    }


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
        $id = $this->route->parameter ('user');


        return [
            'name'=>'required',
            'lastname'=>'required',
            'cedula'=>[Rule::unique ('users', 'cedula')->ignore ($id)],
            'email'=> 'required|unique:users,email,'.$id

        ];

    }
}

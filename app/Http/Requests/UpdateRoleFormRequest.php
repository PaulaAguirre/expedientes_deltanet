<?php

namespace App\Http\Requests;

use App\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Route;

class UpdateRoleFormRequest extends FormRequest
{
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
        $id = $this->route->parameter ('role');
        $role = Role::findOrFail ($id);


        return [
            'nombre'=>Rule::unique ('roles')->ignore ($role->id)

        ];
    }
}

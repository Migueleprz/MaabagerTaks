<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class RegisterRequest extends Request
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
            'name'=> 'required',
            'email'=> 'required|email',
            'password'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=> 'El nombre es obligatorio',
            'email.required'=> 'El Correo es obligatorio',
            'email.email'=> 'El Correo  no es valido',
            'password.required'=> 'La Contraseña es requerida',
        ];
    }
}

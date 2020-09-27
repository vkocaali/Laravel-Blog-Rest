<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'email' => 'E-mail',
            'password' => 'Şifre',
            'device_name' => 'Cihaz Adı',
        ];
    }
}

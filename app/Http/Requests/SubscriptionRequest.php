<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'email' => 'required|email',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Ad Soyad',
            'email' => 'E-mail',
        ];
    }
}

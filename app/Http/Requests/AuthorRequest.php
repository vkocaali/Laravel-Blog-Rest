<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'author_name' => 'required',
            'author_description' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'author_name' => 'Yazar Adı ve Soyadı',
            'author_description' => 'Yazar Açıklama',
        ];
    }

}

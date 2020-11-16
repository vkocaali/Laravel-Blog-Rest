<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function attributes()
    {
        return [
            'image' => 'Resim',
        ];
    }
}

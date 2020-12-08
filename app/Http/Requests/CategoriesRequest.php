<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        if(request()->isMethod('put')){
            return [
                'name' => 'required|max:200',
                'description' => 'required|max:500',
                'slug' => 'required',
                'content' => 'required',
                'parent' => 'required',
                'tags' => 'required',
            ];
        }
        else{
            return [
                'name' => 'required|max:200',
                'description' => 'required|max:500',
                'slug' => 'required',
                'content' => 'required',
                'parent' => 'required',
                'tags' => 'required',
                'image' => 'required'
            ];
        }
    }
    public function attributes()
    {
        return [
            'name' => 'Kategori Adı',
            'description' => 'Kategori Açıklaması',
            'slug' => 'Kategori Slug',
            'content' => 'Kategori İçeriği',
            'parent' => 'Alt Kategori',
            'tags' => 'Etiket',
            'image' => 'Kategori Resim',
        ];
    }
}

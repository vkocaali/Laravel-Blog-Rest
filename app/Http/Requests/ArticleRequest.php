<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        if(request()->isMethod('put')){
            return [
                'title' => 'required',
                'description' => 'required',
                'content' => 'required',
                'slug' => 'required',
                'categories_id' => 'required',
                'author_id' => 'required',
                'tags' => 'required',
            ];
        }
        else{
            return [
                'title' => 'required',
                'description' => 'required',
                'content' => 'required',
                'slug' => 'required',
                'categories_id' => 'required',
                'author_id' => 'required',
                'tags' => 'required',
                'image' => 'required'
            ];
        }

    }
    public function attributes()
    {
        return [
            'title' => 'Başlık',
            'description' => 'Açıklama',
            'content' => 'İçerik',
            'slug' => 'Slug',
            'categories_id' => 'Kategori',
            'author_id' => 'Yazar',
            'tags' => 'required',
            'image' => 'Yazı Resim',
        ];
    }
}

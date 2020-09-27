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
        return [
            'title' => 'required',
            'content' => 'required',
            'slug' => 'required',
            'categories_id' => 'required',
            'author_id' => 'required',
            'tags' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'Başlık',
            'content' => 'İçerik',
            'slug' => 'Slug',
            'categories_id' => 'Kategori',
            'author_id' => 'Yazar',
            'tags' => 'required',
        ];
    }
}

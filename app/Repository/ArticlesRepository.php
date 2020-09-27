<?php

namespace App\Repositories;

use App\Models\Article;

class ArticlesRepository implements ArticlesRepositoryInterface {

    public function get($id){
        return Article::find($id);
    }

    public function all(){
        return Article::all();
    }

    public function create($data){
        return Article::create($data);
    }
    public function delete($id){
        Article::destroy($id);
    }

    public function update($id,$data){
        return Article::find($id)->update($data);
    }

    public function getTags(){
        return Article::all()->tags->where('tag_type',Article::class);
    }

    public function max($varaible){
        return Article::all()->max($varaible);
    }
}

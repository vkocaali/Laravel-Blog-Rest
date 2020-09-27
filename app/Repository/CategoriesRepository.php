<?php

namespace App\Repositories;

use App\Models\Categories;

class CategoriesRepository implements CategoriesRepositoryInterface {

    public function get($id){
        return Categories::find($id);
    }

    public function all(){
        return Categories::all();
    }

    public function create($data){
        return Categories::create($data);
    }
    public function delete($id){
        Categories::destroy($id);
    }

    public function update($id,$data){
        return Categories::find($id)->update($data);
    }

    public function getTags(){
        return Categories::all()->tags->where('tag_type',Categories::class);
    }

    public function max($varaible){
        return Categories::all()->max($varaible);
    }

}

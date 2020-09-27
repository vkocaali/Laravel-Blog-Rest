<?php

namespace App\Repositories;

use App\Models\Author;

class AuthorRepository implements AuthorRepositoryInterface {

    public function get($id){
        return Author::find($id);
    }

    public function all(){
        return Author::all();
    }

    public function create($data){
        return Author::create($data);
    }
    public function delete($id){
        Author::destroy($id);
    }

    public function update($id,$data){
        return Author::find($id)->update($data);
    }
}

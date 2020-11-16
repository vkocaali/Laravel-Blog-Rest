<?php

namespace App\Repositories;

use App\Models\Author;

class AuthorRepository implements AuthorRepositoryInterface {

    public function get($id){
        return Author::find($id);
    }

    public function all($request){
        // ?sortBy=id&sort=DESC&status=1&paginate=3
        $paginate = $request->has('paginate') ? $request->paginate  : 10;
        $query = Author::query();

        if($request->has('search')){
            $query->where('author_name' ,'like', '%'. $request->query('search'). '%');
        }
        if($request->has('sortBy')){
            $query->orderBy($request->query('sortBy'),$request->query('sort','DESC'));
        }
        if($request->has('status') && $request->status !== 'all'){
            if($request->has('status') !== "all"){
                $query->where('is_active',$request->status);
            }
        }
        return $request->paginate == "off" ? $query->get() : $query->paginate($paginate);

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

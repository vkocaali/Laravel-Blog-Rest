<?php

namespace App\Repositories;

use App\Models\Categories;
use App\Models\Tags;
use http\Env\Request;

class CategoriesRepository implements CategoriesRepositoryInterface {

    public function get($id){
        return Categories::find($id);
    }

    public function first($id){
        return Categories::find($id)->firstOrFail();
    }

    public function all($request){

        // ?sortBy=id&sort=DESC&status=1&paginate=3
        $paginate = $request->has('paginate') ? $request->paginate  : 10;
        $query = Categories::query();

        if($request->has('search')){
            $query->where('name' ,'like', '%'. $request->query('search'). '%');
        }
        if($request->has('sortBy')){
            $query->orderBy($request->query('sortBy'),$request->query('sort','DESC'));
        }
        if($request->has('status') && $request->status !== 'all'){
            if($request->has('status') !== "all"){
                $query->where('is_active',$request->status);
            }
        }
        $data = $request->paginate == "off" ? $query->get() : $query->paginate($paginate);
        return $data;
    }

    public function create($data){
        return Categories::create($data);
    }
    public function delete($id){
        Tags::where('tag_id',$id)->where('tag_type',Categories::class)->delete();
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

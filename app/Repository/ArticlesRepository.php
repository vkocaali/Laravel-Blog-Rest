<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\Categories;
use App\Models\Tags;

class ArticlesRepository implements ArticlesRepositoryInterface {

    public function get($id){
        return Article::find($id);
    }

    public function first($id){
        return Article::find($id)->firstOrFail();
    }

    public function orderBy($column, $sort, $where , $take)
    {
        return Article::orderBy($column,$sort)->where('is_active',$where ?? '1')->take($take)->get();
    }


    public function all($request){

        // ?sortBy=id&sort=DESC&status=1&paginate=3
        $paginate = $request->has('paginate') ? $request->paginate  : 10;

        $query = Article::query();

        if($request->has('search')){
            $query->where('title' ,'like', '%'. $request->query('search'). '%');
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
        return Article::create($data);
    }
    public function delete($id){
        Tags::where('tag_id',$id)->where('tag_type',Article::class)->delete();
        Article::destroy($id);
    }

    public function update($id,$data){
        return Article::find($id)->update($data);
    }

    public function getTags(){
        return Article::all()->tags->where('tag_type',Article::class);
    }

    public function where($column , $varaible){
        return Article::where($column , $varaible)->get();
    }
    public function max($varaible){
        return Article::all()->max($varaible);
    }
}

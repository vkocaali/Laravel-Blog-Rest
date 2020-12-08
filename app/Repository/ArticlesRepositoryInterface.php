<?php

namespace App\Repositories;

interface ArticlesRepositoryInterface{

    public function get($id);

    public function first($id);

    public function orderBy($column , $sort , $take);

    public function all($request);

    public function delete($id);

    public function create($data);

    public function update($id,$data);

    public function max($varaible);

    public function getTags();
}

<?php

namespace App\Repositories;

use http\Env\Request;

interface CategoriesRepositoryInterface{

    public function get($id);

    public function first($id);

    public function all($request);

    public function delete($id);

    public function create($data);

    public function update($id,$data);

    public function max($varaible);

    public function getTags();
}

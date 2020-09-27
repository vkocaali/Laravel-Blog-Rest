<?php

namespace App\Repositories;

interface CategoriesRepositoryInterface{

    public function get($id);

    public function all();

    public function delete($id);

    public function create($data);

    public function update($id,$data);

    public function max($varaible);

    public function getTags();
}

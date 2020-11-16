<?php

namespace App\Repositories;

interface AuthorRepositoryInterface{

    public function get($id);

    public function all($request);

    public function delete($id);

    public function create($data);

    public function update($id,$data);

}

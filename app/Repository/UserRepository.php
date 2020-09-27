<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface {

    public function get($id){
        return User::find($id);
    }

    public function all(){
        return User::all();
    }

    public function whereEmail($email){
        return User::where('email',$email);
    }

    public function create($data){
        return User::create($data);
    }
    public function delete($id){
        User::destroy($id);
    }


}

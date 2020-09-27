<?php

namespace App\Repositories;

use App\Models\Author;
use App\Models\Subscription;

class SubscriptionRepository implements SubscriptionRepositoryInterface {

    public function get($id){
        return Subscription::find($id);
    }

    public function all(){
        return Subscription::all();
    }

    public function create($data){
        return Subscription::create($data);
    }
    public function delete($id){
        Subscription::destroy($id);
    }

    public function update($id,$data){
        return Subscription::find($id)->update($data);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;

    protected $table = "storage";
    protected $guarded = [];

    public function categories(){
        return $this->hasOne(Categories::class);
    }

    public function articles(){
        return $this->hasOne(Articles::class);
    }
}

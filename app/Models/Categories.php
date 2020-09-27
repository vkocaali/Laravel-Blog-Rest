<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tags(){
        return $this->hasMany(Tags::class,'tag_id');
    }
    public function parent(){
        return $this->belongsTo(Categories::class);
    }

    public function children(){
        return $this->hasMany(Categories::class);
    }

    public function articles(){
        return $this->hasMany(Article::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tags(){
        return $this->hasMany(Tags::class,'tag_id');
    }

    public function categories(){
        return $this->belongsTo(Categories::class);
    }

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function storage(){
        return $this->belongsTo(Storage::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categories(){
        return $this->belongsTo(Categories::class);
    }
    public function article(){
        return $this->belongsTo(Article::class);
    }

}

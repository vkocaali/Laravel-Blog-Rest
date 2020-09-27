<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{

    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('slug');
            $table->unsignedBigInteger('categories_id');
            $table->unsignedBigInteger('author_id');
            $table->string('is_active');
            $table->string('rank');
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->foreign('author_id')->references('id')->on('authors');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}

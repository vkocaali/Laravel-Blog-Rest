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
            $table->string('description',500);
            $table->text('content');
            $table->string('slug');
            $table->unsignedBigInteger('categories_id');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('storage_id');
            $table->string('is_active');
            $table->string('rank');
            $table->string('favorite');
            $table->foreign('storage_id')->references('id')->on('storage')->onDelete('cascade');
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}

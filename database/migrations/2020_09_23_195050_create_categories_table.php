<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',200);
            $table->string('description',500);
            $table->text('content');
            $table->integer('parent');
            $table->string('slug',600);
            $table->integer('is_active');
            $table->unsignedBigInteger('storage_id');
            $table->foreign('storage_id')->references('id')->on('storage')->onDelete('cascade');
            $table->integer('rank');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}

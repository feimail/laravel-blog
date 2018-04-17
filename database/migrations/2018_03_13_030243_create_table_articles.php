<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('articles', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('category_id')->unsigned()->default(0)->index();
          $table->string('title')->comment('标题');
          $table->string('author')->comment('作者');
          $table->string('cover')->nullable()->comment('首页图');
          $table->string('phrase')->comment('短语 简介');
          $table->longText('content')->nullable();
          $table->boolean('is_top')->default(0);
          $table->boolean('is_hidden')->default(0);
          $table->boolean('is_hidden')->default(1)->change();
          $table->integer('click')->default(0);
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
        Schema::dropIfExists('articles');
    }
}

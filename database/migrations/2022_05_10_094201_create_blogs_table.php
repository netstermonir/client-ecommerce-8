<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->unsignedBigInteger("blog_category_id");
            $table->string("blog_title")->nullable();
            $table->string("slug")->nullable();
            $table->string("thumbnail")->nullable();
            $table->string("description")->nullable();
            $table->string("date")->nullable();
            $table->string("tag")->nullable();
            $table->integer("status")->nullable();
            $table->timestamps();
            $table->foreign("blog_category_id")->references("id")->on("blog_categoy")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}

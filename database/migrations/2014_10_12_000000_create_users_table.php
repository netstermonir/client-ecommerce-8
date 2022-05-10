<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("users", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email")->unique();
            $table->timestamp("email_verified_at")->nullable();
            $table->string("phone")->nullable();
            $table->string("password");
            $table->boolean("is_admin")->nullable();
            $table->boolean("role_admin")->nullable();
            $table->integer("status")->default(0)->nullable();
            $table->string('avatar')->nullable();
            $table->string('provider', 20)->nullable();
            $table->string('provider_id')->nullable();
            $table->string('access_token')->nullable();
            $table->integer('category')->default(0)->nullable();
            $table->integer('product')->default(0)->nullable();
            $table->integer('order')->default(0)->nullable();
            $table->integer('offer')->default(0)->nullable();
            $table->integer('pickup')->default(0)->nullable();
            $table->integer('tricket')->default(0)->nullable();
            $table->integer('setting')->default(0)->nullable();
            $table->integer('blog')->default(0)->nullable();
            $table->integer('contact')->default(0)->nullable();
            $table->integer('report')->default(0)->nullable();
            $table->integer('role')->default(0)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists("users");
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepliedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replied', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tricket_id');
            $table->text('replied_message')->nullable();
            $table->string('replied_image')->nullable();
            $table->string('replied_date')->nullable();
            $table->timestamps();
            $table->foreign('tricket_id')->references('id')->on('trickets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replied');
    }
}

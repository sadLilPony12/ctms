<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable();
            $table->string('title');
            $table->text('message');
            $table->string('reference')->nullable();
            $table->date('start_at');
            $table->date('end_at');
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
            $table->timestamps();
            // index
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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

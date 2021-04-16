<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_items', function (Blueprint $table) {
            $table->id();
           $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('num')->nullable();
            $table->string('brgy');
            $table->string('street')->nullable();
            $table->string('purok')->nullable();
            $table->string('phone')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // index
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_items');
    }
}

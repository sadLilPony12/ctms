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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id'); 
            $table->string('profile_picture');
            $table->string('name');
            //Account
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();  
            $table->string('session_id')->nullable();
            //Personal info
            $table->string('fname');          
            $table->string('mname')->nullable();  
            $table->string('lname');    
            $table->enum('suffix', ['SR', 'JR', 'III', 'IV','V'])->nullable();      
            //put a default 
            $table->boolean('is_male')->default(1)->nullable();
            $table->date('dob');
            $table->string('addR');
            $table->string('addP');
            $table->string('addC');
            $table->string('addB');
            $table->string('addPr')->nullable();
            $table->string('addH')->nullable();

            $table->string('phone')->nullable();
            $table->string('reason')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            //index
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('profileImage');
            $table->string('fname');
            $table->string('lname');
            $table->string('email');
            $table->string('pnum');
            $table->string('address');
            $table->string('zipcode');
            $table->string('username');
            $table->string('password');
            $table->string('bday');
            $table->integer('user_status')->default(1);
            $table->integer('user_type')->default(1);
            $table->integer('funds')->default(0);
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
        Schema::dropIfExists('users');
    }
};

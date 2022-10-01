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
        Schema::create('bidtransactions', function (Blueprint $table) {

            $table->id();
            $table->integer('user_id');
            $table->string('uname');
            $table->integer('prod_id');
            $table->string('prodname');
            $table->float('bidamt');
            $table->integer('bidstatus');
            $table->date('endDate');
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
        Schema::dropIfExists('bidtransactions');
    }
};

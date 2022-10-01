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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); //ORDER ID
            $table->integer('user_id'); //USER_ID (FK)
            $table->float('total'); //TOTAL
            $table->integer('refnum'); //REFNUM
            $table->integer('tracknum'); //TRACKING NUMBER
            $table->date('del_date'); //DELIVERY DATE
            $table->string('del_stat'); //DELIVERY STATUS
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
        Schema::dropIfExists('orders');
    }
};

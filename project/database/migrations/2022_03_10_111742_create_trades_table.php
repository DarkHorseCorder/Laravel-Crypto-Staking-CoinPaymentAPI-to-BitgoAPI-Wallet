<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->string('trade_code');
            $table->integer('offer_id');
            $table->integer('buyer_id');
            $table->integer('seller_id');
            $table->integer('crypto_id');
            $table->integer('fiat_id');
            $table->decimal('crypto_amount',18,8);
            $table->decimal('fiat_amount',18,8);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('trades');
    }
}

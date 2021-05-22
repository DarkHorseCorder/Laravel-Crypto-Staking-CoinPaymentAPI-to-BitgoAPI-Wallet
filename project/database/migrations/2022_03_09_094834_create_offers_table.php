<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['buy','sell']);
            $table->integer('cryp_id');
            $table->integer('gateway_id');
            $table->integer('fiat_id');
            $table->tinyInteger('price_type')->comment('1 = market price, 2 = fixed price');
            $table->decimal('fixed_rate',18,8);
            $table->decimal('margin',5,2);
            $table->decimal('minimum',18,8);
            $table->decimal('maximum',18,8);
            $table->integer('trade_duration');
            $table->text('offer_terms');
            $table->text('trade_instructions');
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
        Schema::dropIfExists('offers');
    }
}

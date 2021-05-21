<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('default')->comment('1 => default, 0 => not default');
            $table->string('symbol')->unique();
            $table->string('code')->unique();
            $table->string('curr_name');
            $table->unsignedInteger('type')->comment('1 => fiat, 2 => crypto');
            $table->unsignedInteger('status')->comment('1 => active, 0 => inactive');
            $table->unsignedDecimal('rate',20,10);
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
        Schema::dropIfExists('currencies');
    }
}

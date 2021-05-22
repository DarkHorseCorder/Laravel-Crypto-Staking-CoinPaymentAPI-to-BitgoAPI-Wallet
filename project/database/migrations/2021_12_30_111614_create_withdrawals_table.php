<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('method_id');
            $table->integer('currency_id');
            $table->decimal('amount',20,10);
            $table->decimal('charge',20,10);
            $table->decimal('total_amount',20,10);
            $table->string('user_data');
            $table->tinyInteger('status')->default(0)->comment('0 => pending, 1 => accepted');
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
        Schema::dropIfExists('withdrawals');
    }
}

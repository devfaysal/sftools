<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlentyMarketProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plenty_market_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('product_name');
            $table->string('mu_varient')->nullable();
            $table->string('ms_varient')->nullable();
            $table->string('on_varient')->nullable();
            $table->string('stock')->nullable();
            $table->string('minimum_stock')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('plenty_market_products');
    }
}

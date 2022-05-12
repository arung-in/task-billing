<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->decimal('cash',8,2)->default(0);
            $table->decimal('total_price_without_tax',8,2)->default(0);
            $table->decimal('total_tax_payable',8,2)->default(0);
            $table->decimal('net_total',8,2)->default(0);
            $table->decimal('net_total_rounded_down')->default(0);
            $table->decimal('balance_payable_to_customer',8,2)->default(0);
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
        Schema::dropIfExists('sell');
    }
}

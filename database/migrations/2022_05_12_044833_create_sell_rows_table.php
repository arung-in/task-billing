<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_rows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sell_id')->nullable();
            $table->foreign('sell_id')->references('id')->on('sell')->onDelete('set null');
            $table->string('sku');
            $table->decimal('qty',8,2)->default(0);
            $table->decimal('price',8,2)->default(0);
            $table->string('tax');
            $table->decimal('tax_amount',8,2)->default(0);
            $table->decimal('sub_total',8,2)->default(0);            
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
        Schema::dropIfExists('sell_rows');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('salesid');
            $table->integer('proid');
            $table->double('buyprice')->nullable();
            $table->double('sellprice')->nullable();
            $table->integer('qty')->nullable();
            $table->double('revenue')->nullable();
            $table->double('subtotal')->nullable();
            $table->string('type');
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
        Schema::dropIfExists('sales_records');
    }
}

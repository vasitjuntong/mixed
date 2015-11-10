<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_receives', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('receive_id')
                ->unsigned();
            $table->integer('product_id')
                ->unsigned();

            $table->integer('qty');
            $table->string('status', 100);

            $table->timestamps();

            $table->foreign('receive_id')
              ->references('id')->on('receives')
              ->onDelete('cascade');

            $table->foreign('product_id')
              ->references('id')->on('products')
              ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stock_receives');
    }
}

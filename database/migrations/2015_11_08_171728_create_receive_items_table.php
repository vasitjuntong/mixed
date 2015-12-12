<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiveItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receive_items', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('receive_id')
                ->unsigned();
            $table->integer('product_id')
                ->unsigned();

            $table->string('mix_no');
            $table->string('product_code');
            $table->longText('product_description');

            $table->integer('location_id')
                ->unsigned();
            $table->string('location_name');

            $table->integer('qty');
            $table->longText('remark')->nullable();
            $table->string('status', 100);

            $table->timestamps();

            $table->foreign('receive_id')
              ->references('id')->on('receives')
              ->onDelete('cascade');
            
            $table->foreign('product_id')
              ->references('id')->on('products')
              ->onDelete('cascade');
            
            $table->foreign('location_id')
              ->references('id')->on('locations')
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
        Schema::drop('receive_items');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('product_type_id')
                ->unsigned();
            $table->integer('unit_id')
                ->unsigned();

            $table->string('code');
            $table->longText('description');
            $table->integer('stock_min')->unsigned();
            $table->string('use_serial_no', 20);
            $table->string('pic_path');
            $table->string('pic_name');
            $table->timestamps();

            $table->foreign('product_type_id')
              ->references('id')->on('product_types')
              ->onDelete('cascade');

            $table->foreign('unit_id')
              ->references('id')->on('units')
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
        Schema::drop('products');
    }
}

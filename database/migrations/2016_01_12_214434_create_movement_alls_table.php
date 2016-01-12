<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementAllsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movement_alls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_id')->index()->nullable();
            $table->string('type')->index()->nullable();
            $table->string('project')->index()->nullable();
            $table->string('dn')->index()->nullable();
            $table->string('product_mix_no')->index()->nullable();
            $table->string('product_description')->index()->nullable();
            $table->string('product_qty')->index()->nullable();
            $table->string('product_unit')->index()->nullable();
            $table->string('product_remark')->index()->nullable();
            $table->string('location_or_site_name')->index()->nullable();
            $table->string('status')->index()->nullable();
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
        Schema::drop('movement_alls');
    }
}

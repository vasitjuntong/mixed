<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnProductTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_types', function(Blueprint $table){

            $table->dropColumn(['code_prefix', 'code_default']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_types', function(Blueprint $table){

            $table->string('code_prefix')->after('name');
            $table->string('code_default')->after('code_prefix');
        });
    }
}

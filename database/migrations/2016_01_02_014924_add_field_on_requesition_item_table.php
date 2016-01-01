<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldOnRequesitionItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requesition_items', function(Blueprint $table){
            $table->string('group')->after('product_id')->nullable();
            $table->string('number')->after('group')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requesition_items', function (Blueprint $table) {
            $table->dropColumn(['group', 'number']);
        });
    }
}

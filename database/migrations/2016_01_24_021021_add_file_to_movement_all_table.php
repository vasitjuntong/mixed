<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileToMovementAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movement_alls', function(Blueprint $table){
            $table->string('ref_no')->after('dn')->nullable();
            $table->string('po_no')->after('ref_no')->nullable();
            $table->string('created_by')->after('po_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movement_alls', function(Blueprint $table){
            $table->dropColumn(['ref_no', 'po_no', 'created_by']);
        });
    }
}

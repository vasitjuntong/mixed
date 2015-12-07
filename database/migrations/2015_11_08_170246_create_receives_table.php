<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receives', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')
                ->unsigned();
            $table->string('document_no', 100);
            $table->string('po_no', 100);
            $table->string('ref_no');

            $table->integer('project_id')
                ->unsigned();

            $table->string('project_code');

            $table->string('status', 100);
            $table->longText('remark');

            $table->timestamps();

            $table->foreign('project_id')
              ->references('id')->on('projects')
              ->onDelete('cascade');

            $table->foreign('user_id')
              ->references('id')->on('users')
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
        Schema::drop('receives');
    }
}

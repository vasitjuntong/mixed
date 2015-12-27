<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequesitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requesitions', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->string('project_code');
            $table->string('document_no');
            $table->string('site_id');
            $table->string('site_name');
            $table->string('receive_company_name');
            $table->string('receive_contact_name');
            $table->string('receive_phone_name');
            $table->string('status');
            $table->timestamp('receive_date');
            $table->timestamps();

            $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');

            $table->foreign('project_id')
              ->references('id')->on('projects')
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
        Schema::drop('requesitions');
    }
}

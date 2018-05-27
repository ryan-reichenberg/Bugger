<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuxilaryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });
        Schema::create('tickets', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->boolean('closed')->default(false);
            $table->string('priority');
            $table->timestamps();
        });
        Schema::create('actions', function (Blueprint $table){
            $table->increments('id');
            $table->integer('ticket_id');
            $table->string('action');
            $table->integer('user_id');
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
        Schema::dropIfExists('projects');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('actions');
    }
}

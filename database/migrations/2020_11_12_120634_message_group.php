<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MessageGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msggrops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('msg');
            $table->text('type');
            $table->text('time');
            $table->text('groupName');
            $table->text('sender');
            $table->text('filename')->nullable();
            $table->integer('userId')->nullable();
            $table->integer('roleId')->nullable();
            $table->integer('roomId')->nullable();
            $table->text('userImage')->nullable();
            $table->integer('reading')->nullable();
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
        Schema::dropIfExists('msggrops');
    }
}

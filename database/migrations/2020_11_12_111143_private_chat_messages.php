<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PrivateChatMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('sender');
            $table->integer('idSender');
            $table->text('roleSender');
            $table->text('receiver');
            $table->integer('idReceiver');
            $table->text('roleReceiver');
            $table->text('message');
            $table->text('type');
            $table->text('time');
            $table->text('filename')->nullable();
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
        Schema::dropIfExists('messages');
    }
}

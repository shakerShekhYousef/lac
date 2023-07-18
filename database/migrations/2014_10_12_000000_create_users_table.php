<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('national_number')->unique()->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->string('code')->unique()->nullable();
            $table->unsignedBigInteger('role_id');
            $table->bigInteger('count_login')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('has_changes')->default(0);
            $table->boolean('groups_request')->default(0);
            $table->boolean('password_change')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
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
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student');
            $table->unsignedBigInteger('type_procedure_id');
            $table->text('reason');
            $table->unsignedBigInteger('forward_to')->nullable();
            $table->boolean('is_done')->default(0);
            $table->timestamps();
            $table->foreign('type_procedure_id')
                ->references('id')
                ->on('procedure_types')
                ->onDelete('cascade');
            $table->foreign('forward_to')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('student_requests');
    }
}

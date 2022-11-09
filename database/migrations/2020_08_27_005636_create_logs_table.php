<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('action', 512);
            $table->string('endpoint', 1024);
            $table->text('raw_request');
            $table->text('raw_response');
            $table->text('parsed_request');
            $table->text('parsed_response');
            $table->text('extra_info')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}

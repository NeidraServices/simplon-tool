<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvalNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eval_notifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('from')->unsigned();
            $table->foreign('from')->references('id')->on('users');
            $table->bigInteger('to')->unsigned();
            $table->foreign('to')->references('id')->on('users');
            $table->string('object');
            $table->string('isRead');
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
        Schema::dropIfExists('eval_notifications');
    }
}

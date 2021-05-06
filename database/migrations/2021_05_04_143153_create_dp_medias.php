<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpMedias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dp_medias', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('nom');
            $table->string('lien');
            $table->bigInteger('rendu_id')->unsigned();
            $table->foreign('rendu_id')->references('id')->on('dp_rendus');
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
        Schema::dropIfExists('dp_medias');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpProjets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dp_projets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('formateur_id')->unsigned();
            $table->foreign('formateur_id')->references('id')->on('users');
            $table->string('titre');
            $table->datetime('deadline');
            $table->datetime('date_presentation')->nullable();
            $table->text('description');
            $table->text('extrait');
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
        Schema::dropIfExists('dp_projets');
    }
}


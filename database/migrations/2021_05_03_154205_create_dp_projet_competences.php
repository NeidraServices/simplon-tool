<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpProjetCompetences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dp_projet_competences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('projet_id')->unsigned();
            $table->foreign('projet_id')->references('id')->on('dp_projets');
            $table->bigInteger('competence_id')->unsigned();
            $table->foreign('competence_id')->references('id')->on('dp_competences');
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
        Schema::dropIfExists('dp_projet_competences');
    }
}

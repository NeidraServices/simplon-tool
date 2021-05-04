<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvalSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eval_skills', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->bigInteger('referentiel_id')->unsigned();
            $table->foreign('referentiel_id')->references('id')->on('eval_referentiels');
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
        Schema::dropIfExists('eval_skills');
    }
}

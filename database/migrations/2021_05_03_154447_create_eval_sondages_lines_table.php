<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvalSondagesLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eval_sondages_lines', function (Blueprint $table) {
            $table->id();
            $table->float('note')->nullable();
            $table->bigInteger('sondage_id')->unsigned();
            $table->foreign('sondage_id')->references('id')->on('eval_sondages');
            $table->bigInteger('langage_id')->unsigned()->nullable();
            $table->foreign('langage_id')->references('id')->on('eval_langages');
            $table->bigInteger('skill_id')->unsigned();
            $table->foreign('skill_id')->references('id')->on('eval_skills');
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
        Schema::dropIfExists('eval_sondages_lines');
    }
}

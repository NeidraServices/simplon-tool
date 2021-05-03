<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpCommentaires extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dp_commentaires', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('projet_id')->nullable()->constrained();
            $table->foreignId('commentaire_id')->nullable()->constrained();
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
        Schema::dropIfExists('dp_commentaires');
    }
}
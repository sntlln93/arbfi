<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoreboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoreboards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tournament_id');
            $table->integer('team_id');
            $table->integer('points')->default(0);
            $table->integer('wins')->default(0);
            $table->integer('losses')->default(0);
            $table->integer('ties')->default(0);
            $table->integer('goals_favor')->default(0);
            $table->integer('goals_against')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scoreboards');
    }
}

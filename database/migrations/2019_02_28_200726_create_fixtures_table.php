<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tournament_id');
            $table->integer('local_team_id');
            $table->integer('visiting_team_id');
            $table->date('date');
            $table->String('fixture_day');
            $table->String('location');
            $table->integer('local_score');
            $table->integer('visiting_score');
            $table->String('state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fixtures');
    }
}

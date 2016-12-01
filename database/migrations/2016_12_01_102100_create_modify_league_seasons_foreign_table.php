<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModifyLeagueSeasonsForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('league_seasons', function ($table) {
            $table->dropForeign('league_seasons_league_id_foreign');
        });

        Schema::table('league_seasons', function ($table) {
            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('league_seasons', function ($table) {
            $table->dropForeign('league_seasons_league_id_foreign');
        });

        Schema::table('league_seasons', function ($table) {
            $table->foreign('league_id')->references('id')->on('leagues');
        });
    }
}

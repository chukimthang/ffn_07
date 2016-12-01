<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModifyPlayerAwardsForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('player_awards', function ($table) {
            $table->dropForeign('player_awards_player_id_foreign');
            $table->dropForeign('player_awards_league_season_id_foreign');
            $table->dropForeign('player_awards_match_id_foreign');
        });

        Schema::table('player_awards', function ($table) {
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('league_season_id')->references('id')->on('league_seasons')->onDelete('cascade');
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('player_awards', function ($table) {
            $table->dropForeign('player_awards_player_id_foreign');
            $table->dropForeign('player_awards_league_season_id_foreign');
            $table->dropForeign('player_awards_match_id_foreign');
        });

        Schema::table('player_awards', function ($table) {
            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('league_season_id')->references('id')->on('league_seasons');
            $table->foreign('match_id')->references('id')->on('matches');
        });
    }
}

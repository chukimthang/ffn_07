<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModifyTeamAchievementsForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_achievements', function ($table) {
            $table->dropForeign('team_achievements_league_season_id_foreign');
            $table->dropForeign('team_achievements_team_id_foreign');
        });

        Schema::table('team_achievements', function ($table) {
            $table->foreign('league_season_id')->references('id')->on('league_seasons')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('team_achievements', function ($table) {
            $table->dropForeign('team_achievements_league_season_id_foreign');
            $table->dropForeign('team_achievements_team_id_foreign');
        });

        Schema::table('team_achievements', function ($table) {
            $table->foreign('league_season_id')->references('id')->on('league_seasons');
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }
}

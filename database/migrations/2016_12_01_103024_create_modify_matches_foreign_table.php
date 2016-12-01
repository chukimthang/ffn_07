<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModifyMatchesForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matches', function ($table) {
            $table->dropForeign('matches_league_season_id_foreign');
        });

        Schema::table('matches', function ($table) {
            $table->foreign('league_season_id')->references('id')->on('league_seasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matches', function ($table) {
            $table->dropForeign('matches_league_season_id_foreign');
        });

        Schema::table('matches', function ($table) {
            $table->foreign('league_season_id')->references('id')->on('league_seasons');
        });
    }
}

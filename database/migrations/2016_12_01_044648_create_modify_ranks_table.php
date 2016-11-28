<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModifyRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ranks', function ($table) {
            $table->integer('won')->default(0)->change();
            $table->integer('drawn')->default(0)->change();
            $table->integer('lost')->default(0)->change();
            $table->integer('gd')->default(0)->change();
            $table->integer('score')->default(0)->change();
        });

        Schema::table('ranks', function ($table) {
            $table->dropForeign('ranks_team_id_foreign');
            $table->dropForeign('ranks_league_season_id_foreign');
        });

        Schema::table('ranks', function ($table) {
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade')->change();
            $table->foreign('league_season_id')->references('id')->on('league_seasons')->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ranks', function ($table) {
            $table->integer('won')->change();
            $table->integer('drawn')->change();
            $table->integer('lost')->change();
            $table->integer('gd')->change();
            $table->integer('score')->change();
        });

        Schema::table('ranks', function ($table) {
            $table->dropForeign('ranks_team_id_foreign');
            $table->dropForeign('ranks_league_season_id_foreign');
        });

        Schema::table('ranks', function ($table) {
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('league_season_id')->references('id')->on('league_seasons');
        });
    }
}

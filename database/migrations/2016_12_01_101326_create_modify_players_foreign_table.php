<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModifyPlayersForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function ($table) {
            $table->dropForeign('players_team_id_foreign');
            $table->dropForeign('players_country_id_foreign');
        });

        Schema::table('players', function ($table) {
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('players', function ($table) {
            $table->dropForeign('players_team_id_foreign');
            $table->dropForeign('players_country_id_foreign');
        });

        Schema::table('players', function ($table) {
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }
}

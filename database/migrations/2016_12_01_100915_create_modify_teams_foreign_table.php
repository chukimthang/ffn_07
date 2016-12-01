<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModifyTeamsForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function ($table) {
            $table->dropForeign('teams_country_id_foreign');
        });

        Schema::table('teams', function ($table) {
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
        Schema::table('teams', function ($table) {
            $table->dropForeign('teams_country_id_foreign');
        });

        Schema::table('teams', function ($table) {
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }
}

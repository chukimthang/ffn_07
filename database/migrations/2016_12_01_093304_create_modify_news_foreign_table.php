<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModifyNewsForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function ($table) {
            $table->dropForeign('news_cate_id_foreign');
            $table->dropForeign('news_country_id_foreign');
        });

        Schema::table('news', function ($table) {
            $table->foreign('cate_id')->references('id')->on('categories')->onDelete('cascade');
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
       Schema::table('news', function ($table) {
            $table->dropForeign('news_cate_id_foreign');
            $table->dropForeign('news_country_id_foreign');
        });

        Schema::table('news', function ($table) {
            $table->foreign('cate_id')->references('id')->on('categories');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }
}

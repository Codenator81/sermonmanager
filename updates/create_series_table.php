<?php namespace Sitesforchurch\SermonManager\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateSeriesTable extends Migration
{

    public function up()
    {
        Schema::create('sitesforchurch_sermonmanager_series', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->index();
            $table->string('artwork')->nullable();
            $table->text('description')->nullable();
            $table->string('sermons')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sitesforchurch_sermonmanager_series');
    }

}

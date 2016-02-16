<?php namespace Sitesforchurch\SermonManager\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateSpeakersTable extends Migration
{

    public function up()
    {
        Schema::create('sitesforchurch_sermonmanager_speakers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->index();
            $table->string('title')->nullable();
            $table->text('bio')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sitesforchurch_sermonmanager_speakers');
    }

}

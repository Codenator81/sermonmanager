<?php namespace Sitesforchurch\SermonManager\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateSermonsTable extends Migration
{

    public function up()
    {
        Schema::create('sitesforchurch_sermonmanager_sermons', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->index();
            $table->string('text')->nullable();
            $table->integer('speaker_id')->unsigned()->nullable()->index();
            $table->integer('series_id')->unsigned()->nullable()->index();
            $table->string('service')->nullable();
            $table->text('description')->nullable();
            $table->string('audio')->nullable();
            $table->string('handout')->nullable();
            $table->string('slides')->nullable();
            $table->date('date_preached')->nullable();
            $table->timestamp('date_added')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sitesforchurch_sermonmanager_sermons');
    }

}

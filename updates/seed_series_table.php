<?php namespace SitesForChurch\SermonManager\Updates;

use Seeder;
use SitesForChurch\SermonManager\Models\Series as SeriesModel;

/**
 * Class SeedSeriesTable
 * @package SitesForChurch\SermonManager\Updates
 */
class SeedSeriesTable extends Seeder
{

    /**
     * @return void
     */
    public function run()
    {
        SeriesModel::create([
            'title'        => 'No series',
            'slug'         => 'no-series',
            'description' => 'Empty series'
        ]);
    }

}
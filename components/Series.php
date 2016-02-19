<?php namespace SitesForChurch\Sermonmanager\Components;

use Cms\Classes\ComponentBase;

class Series extends ComponentBase
{
    /**
     * @var \SitesForChurch\SermonManager\Models\Series The sermon model used for display.
     */
    public $series;

    public function componentDetails()
    {
        return [
            'name'        => 'series Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
          'slug' => [
            'title'       => 'Series slug',
            'description' => 'Look up the series using the supplied slug value.',
            'default'     => '{{ :slug }}',
            'type'        => 'string'
          ]
        ];
    }
    public function onRun()
    {
        $this->series = $this->page['series'] = $this->loadSeries();
    }

    protected function loadSeries()
    {
        $slug = $this->property('slug');
        $series = \SitesForChurch\SermonManager\Models\Series::where('slug', $slug)->first();

        return $series;
    }

}
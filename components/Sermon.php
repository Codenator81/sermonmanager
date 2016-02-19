<?php namespace SitesForChurch\Sermonmanager\Components;

use Cms\Classes\ComponentBase;
use SitesForChurch\SermonManager\Models\Sermon as OneSermon;


class Sermon extends ComponentBase
{
    /**
     * @var OneSermon The sermon model used for display.
     */
    public $sermon;

    public function componentDetails()
    {
        return [
            'name'        => 'Single Sermon',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
          'slug' => [
            'title'       => 'Sermon slug',
            'description' => 'Look up the sermon using the supplied slug value.',
            'default'     => '{{ :slug }}',
            'type'        => 'string'
          ]
        ];
    }
    public function onRun()
    {
        $this->sermon = $this->page['sermon'] = $this->loadSermon();
    }

    protected function loadSermon()
    {
        $slug = $this->property('slug');
        $sermon = OneSermon::isPublished()->where('slug', $slug)->first();

        return $sermon;
    }
}
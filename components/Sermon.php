<?php namespace Sitesforchurch\Sermonmanager\Components;

use Cms\Classes\ComponentBase;
use Sitesforchurch\SermonManager\Models\Sermon as singleSermon;


class Sermon extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Single Sermon',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
    public function onRun()
    {

    }
}
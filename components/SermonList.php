<?php namespace Sitesforchurch\Sermonmanager\Components;

use Redirect;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Sitesforchurch\SermonManager\Models\Sermon;


class SermonList extends ComponentBase
{

    /**
     * A collection of sermoms to display.
     * @var string
     */
    public $sermons;
    
    /**
     * The series the sermon belongs to to display.
     * @var string
     */
    public $series;
    
    /**
     * The speaker the sermon belongs to.
     * @var string
     */
    public $speaker;
    
    /**
     * Parameter to use for the page number.
     * @var string
     */
    public $pageParam;
    
    /**
     * Message to display when there are no sermons..
     * @var string
     */
    public $noPostsMessage;
    
    /**
     * Reference to the page name for linking to individual sermons.
     * @var string
     */
    public $sermonPage;
    
    /**
     * Reference to the page name for linking to series.
     * @var string
     */
    public $seriesPage;

    /**
     * If the post list should be ordered by another attribute.
     * @var string
     */
    public $sortOrder;

    public function componentDetails()
    {
        return [
            'name'        => 'sermon list',
            'description' => 'For creating a listing of sermons. i.e. The sermons page.'
        ];
    }

    public function defineProperties()
    {
        return [
            'order' => [
                'title' => 'Order',
                'placeholder' => 'asc or desc',
                'type' => 'dropdown',
                'default' => 'asc'
            ],
            'pageNumber' => [
                'title' => 'Page Number',
                'description' => 'How Many Pages',
                'type' => 'string',
                'default' => '{{ :page }}',
            ],
            'seriesFilter' => [
                'title'       => 'Series Filter',
                'description' => 'Which series are you wanting to display',
                'type'        => 'string',
                'default'     => ''
            ],
            'sermonsPerPage' => [
                'title'             => 'Sermons per page',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'It works',
                'default'           => '10',
            ],
            'noPostsMessage' => [
                'title'        => 'No Sermons Message',
                'description'  => 'What to display when no sermons are available',
                'type'         => 'string',
                'default'      => 'No sermons found',
                'showExternalParam' => false
            ],
            'sortOrder' => [
                'title'       => 'Sort order',
                'description' => 'How do you want the sermons sorted',
                'type'        => 'dropdown',
                'default'     => 'published_at desc'
            ],
            'seriesPage' => [
                'title'       => 'Series Page',
                'description' => 'what page to send the series links to.',
                'type'        => 'dropdown',
                'default'     => 'series',
                'group'       => 'Links',
            ],
            'sermonPage' => [
                'title'       => 'Sermon Page',
                'description' => 'what page to send the sermon links to',
                'type'        => 'dropdown',
                'default'     => 'sermon',
                'group'       => 'Links',
            ],
//            'speakerPage' => [
//                'title'       => 'Speaker Page',
//                'description' => 'what page to send the speaker links to',
//                'type'        => 'dropdown',
//                'default'     => 'blog/post',
//                'group'       => 'Links',
//            ]
        ];
    }

    public function getSeriesPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getSermonPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getSortOrderOptions()
    {
        return Sermon::$allowedSortingOptions;
    }
    
    public function onRun()
    {
        $this->prepareVars();
        $this->sermons = $this->page['sermons'] = $this->listSermons();
        /*
         * If the page number is not valid, redirect
         */
        if ($pageNumberParam = $this->paramName('pageNumber')) {
            $currentPage = $this->property('pageNumber');

            if ($currentPage > ($lastPage = $this->sermons->lastPage()) && $currentPage > 1)
                return Redirect::to($this->currentPageUrl([$pageNumberParam => $lastPage]));
        }
    }

    protected function prepareVars()
    {
        $this->pageParam = $this->page['pageParam'] = $this->paramName('pageNumber');
        $this->noPostsMessage = $this->page['noPostsMessage'] = $this->property('noPostsMessage');

        /*
         * Sermon links
         */
        $this->sermonPage = $this->page['sermonPage'] = $this->property('sermonPage');
        $this->seriesPage = $this->page['seriesPage'] = $this->property('seriesPage');
    }

    protected function listSermons()
    {
        /*
         * List all the sermons, eager load their series
         */
        $sermons = Sermon::with('series', 'speaker')->listFrontEnd([
            'page'       => $this->property('pageNumber'),
            'sort'       => $this->property('sortOrder'),
            'perPage'    => $this->property('sermonsPerPage')
        ]);

        /*
         * Add a "url" helper attribute for linking to each post and category
         */
        $sermons->each(function($sermon) {

            $sermon->setUrl($this->sermonPage, $this->controller);
            $sermon->series->setUrl($this->seriesPage, $this->controller);
        });

        return $sermons;
    }
}
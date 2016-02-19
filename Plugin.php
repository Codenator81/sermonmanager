<?php namespace SitesForChurch\SermonManager;

use Backend;
use System\Classes\PluginBase;

/**
 * sermonManager Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Sermon Manager',
            'description' => 'Add and categorize your sermons',
            'author'      => 'SitesForChurch',
            'icon'        => 'icon-microphone'
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {

        return [
            'SitesForChurch\SermonManager\Components\SermonList' => 'sermonList',
            'SitesForChurch\SermonManager\Components\Sermon' => 'sermon',
            'SitesForChurch\SermonManager\Components\Series' => 'series'
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {

        return [
            'sitesforchurch.sermonmanager.sermons' => [
                'tab' => 'sermonManager',
                'label' => 'Add Sermons'
            ],
            'sitesforchurch.sermonmanager.series' => [
                'tab' => 'sermonManager',
                'label' => 'Add Series'
            ],
            'sitesforchurch.sermonmanager.speakers' => [
                'tab' => 'sermonManager',
                'label' => 'Add Speakers'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {

        return [
            'sermonmanager' => [
                'label'       => 'Sermons',
                'url'         => Backend::url('sitesforchurch/sermonmanager/sermons'),
                'icon'        => 'icon-microphone',
                'permissions' => ['sitesforchurch.sermonmanager.*'],
                'order'       => 501,
                'sideMenu' => [
                    'sermons' => [
                        'label' => 'Sermons',
                        'icon' =>  'icon-microphone',
                        'url'  => Backend::url('sitesforchurch/sermonmanager/sermons'),
                        'permissions' => ['sitesforchurch.sermonmanager.sermons']
                    ],
                    'speakers' => [
                        'label' => 'Speakers',
                        'icon' =>  'icon-users',
                        'url'  => Backend::url('sitesforchurch/sermonmanager/speakers'),
                        'permissions' => ['sitesforchurch.sermonmanager.speakers']
                    ],
                    'series' => [
                        'label' => 'Series',
                        'icon' =>  'icon-sitemap',
                        'url'  => Backend::url('sitesforchurch/sermonmanager/series'),
                        'permissions' => ['sitesforchurch.sermonmanager.series']
                    ]
                ]
            ],
        ];
    }

}

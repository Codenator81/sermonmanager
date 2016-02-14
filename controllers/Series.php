<?php namespace Sitesforchurch\SermonManager\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Series Back-end Controller
 */
class Series extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Sitesforchurch.SermonManager', 'sermonmanager', 'series');
    }
}
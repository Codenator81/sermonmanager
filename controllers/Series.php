<?php namespace SitesForChurch\SermonManager\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use SitesForChurch\SermonManager\Models\Series as SeriesModel;

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

        BackendMenu::setContext('SitesForChurch.SermonManager', 'sermonmanager', 'series');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $seriesId) {
                if ((!$series = SeriesModel::find($seriesId)))
                    continue;

                $series->delete();
            }

            Flash::success('Successfully deleted those series.');
        }

        return $this->listRefresh();
    }
}
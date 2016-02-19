<?php namespace SitesForChurch\SermonManager\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use SitesForChurch\SermonManager\Models\Sermon as SermonModel;

/**
 * Sermons Back-end Controller
 */
class Sermons extends Controller
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

        BackendMenu::setContext('SitesForChurch.SermonManager', 'sermonmanager', 'sermons');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $sermonId) {
                if ((!$sermon = SermonModel::find($sermonId)))
                    continue;

                $sermon->delete();
            }

            Flash::success('Successfully deleted those sermons.');
        }

        return $this->listRefresh();
    }
}
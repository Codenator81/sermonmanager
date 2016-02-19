<?php namespace SitesForChurch\SermonManager\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use SitesForChurch\SermonManager\Models\Speaker as SpeakerModel;

/**
 * Speakers Back-end Controller
 */
class Speakers extends Controller
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

        BackendMenu::setContext('SitesForChurch.SermonManager', 'sermonmanager', 'speakers');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $speakerId) {
                if ((!$speaker = SpeakerModel::find($speakerId)))
                    continue;

                $speaker->delete();
            }

            Flash::success('Successfully deleted those speakers.');
        }

        return $this->listRefresh();
    }
}
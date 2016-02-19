<?php namespace SitesForChurch\SermonManager\Models;

use Model;

/**
 * series Model
 */
class Series extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'sitesforchurch_sermonmanager_series';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'sermons' => 'SitesForChurch\SermonManager\Models\Sermon'
    ];
    public $attachOne = [
        'artwork' => 'System\Models\File'
    ];

    /**
     * Sets the "url" attribute with a URL to this object
     * @param string $pageName
     * @param Cms\Classes\Controller $controller
     */
    public function setUrl($pageName, $controller)
    {
        $params = [
            'id' => $this->id,
            'slug' => $this->slug,
        ];

        return $this->url = $controller->pageUrl($pageName, $params);
    }

}
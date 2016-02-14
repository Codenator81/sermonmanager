<?php namespace Sitesforchurch\SermonManager\Models;

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
    'sermons' => 'Sitesforchurch\SermonManager\Models\Sermon'
    ];
    public $attachOne = [
    'artwork' => 'System\Models\File'
    ];

}
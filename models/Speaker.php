<?php namespace Sitesforchurch\SermonManager\Models;

use Model;

/**
 * speaker Model
 */
class Speaker extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'sitesforchurch_sermonmanager_speakers';

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
    public $hasOne = [];
    public $hasMany = [
    'sermons' => 'Sitesforchurch\SermonManager\Models\Sermon'
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'thumbnail' => 'System\Models\File'
    ];
    public $attachMany = [];

}
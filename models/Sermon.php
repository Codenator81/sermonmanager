<?php namespace Sitesforchurch\SermonManager\Models;

use Model;

/**
 * sermon Model
 */
class Sermon extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'sitesforchurch_sermonmanager_sermons';

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
    public $hasMany = [];
    public $belongsTo = [
        'speaker' => 'Sitesforchurch\SermonManager\Models\Speaker',
        'series' => 'Sitesforchurch\SermonManager\Models\Series'
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}
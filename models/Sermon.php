<?php namespace Sitesforchurch\SermonManager\Models;

use Model;
use Sitesforchurch\SermonManager\Controllers\Series;

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
     * The attributes on which the sermon list can be ordered
     * @var array
     */
    public static $allowedSortingOptions = array(
        'title asc' => 'Title (ascending)',
        'title desc' => 'Title (descending)',
        'created_at asc' => 'Created (ascending)',
        'created_at desc' => 'Created (descending)',
        'updated_at asc' => 'Updated (ascending)',
        'updated_at desc' => 'Updated (descending)',
        'date_added asc' => 'Date added (ascending)',
        'date_added desc' => 'Date added (descending)',
        'random' => 'Random'
    );

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
        'speaker' => ['Sitesforchurch\SermonManager\Models\Speaker'],
        'series'  => ['Sitesforchurch\SermonManager\Models\Series'],
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

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

        if (array_key_exists('series', $this->getRelations())) {
            $series = $this->find(1)->series;
            $params['series'] = $series->count() ? $series->first()->slug : null;
        }
        return $this->url = $controller->pageUrl($pageName, $params);
    }

    //
    // Scopes
    //

    public function scopeIsPublished($query)
    {
        return $query
            ->whereNotNull('is_published')
            ->where('is_published', true)
            ;
    }

    /**
     * Lists sermons for the front end
     * @param  array $options Display options
     * @return self
     */
    public function scopeListFrontEnd($query, $options)
    {
        /*
         * Default options
         */
        extract(array_merge([
            'page'       => 1,
            'perPage'    => 30,
            'sort'       => 'created_at',
            'published'  => true
        ], $options));

        if ($published) {
            $query->isPublished();
        }

        if ($seriesFilter) {
            $query->whereHas('series', function ($query) {
                $query->where('title', 'like', '%One%');
            });
        }
        /*
         * Sorting
         */
        if (!is_array($sort)) {
            $sort = [$sort];
        }

        foreach ($sort as $_sort) {

            if (in_array($_sort, array_keys(self::$allowedSortingOptions))) {
                $parts = explode(' ', $_sort);
                if (count($parts) < 2) {
                    array_push($parts, 'desc');
                }
                list($sortField, $sortDirection) = $parts;
                if ($sortField == 'random') {
                    $sortField = DB::raw('RAND()');
                }
                $query->orderBy($sortField, $sortDirection);
            }
        }

        return $query->paginate($perPage, $page);
    }
}
<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblSite
 * 
 * @property int $id
 * @property string $url
 * @property string $name
 * @property int $depth
 * @property int $interval
 * @property string $site_color
 * @property string $site_type
 * @property string $exclude_url
 * @property string $last_url
 * @property Carbon $last_pub_date
 * @property Carbon $last_scanned
 * @property Carbon $last_scanned_local
 *
 * @package App\Models
 */
class TblSite extends Model
{
	protected $table = 'tbl_sites';
	protected $hidden = [
		'exclude_url',
		'last_url',
		'last_pub_date',
		'last_scanned',
		'last_scanned_local',
		'external'
	];
	public $timestamps = false;

	protected $casts = [
		'depth' => 'int',
		'interval' => 'int'
	];

	protected $fillable = [
		'url',
		'name',
		'crawl',
		'depth',
		'interval',
		'site_color',
		'site_type',
		'site_selector',
		'selector_value',
		'external'
	];

	/**
     * Get all of the posts for the country.
     */
    public function site_categories()
    {
        return $this->hasMany(TblSiteCategory::class, 'site_id');
	}

	/**
     * Get all of the posts for the country.
     */
    public function categories()
    {
        return $this->hasManyThrough(
			'App\Models\TblCategory', 
			'App\Models\TblSiteCategory',
			'site_id', 
			'id', 
			'id', 
			'category_id'
		)->select(['category_id', 'name']);
	}
}

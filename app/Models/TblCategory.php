<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TblCategory
 * 
 * @property int $id
 * @property string $name
 * @property int $priority
 *
 * @package App\Models
 */
class TblCategory extends Model
{
	protected $table = 'tbl_categories';
	protected $hidden = ['priority', 'topic_id'];
	public $timestamps = false;

	protected $casts = [
		'priority' => 'int'
	];

	protected $fillable = [
		'name',
		'priority'
	];

	/**
     * Get all of the posts for the country.
     */
    public function topics()
    {
        return $this->hasManyThrough(TblTopic::class, TblTopicCategory::class, 'category_id', 'topic_id')->select(['category_id']);
	}
	
	/**
     * Get all of the posts for the country.
     */
    public function sites()
    {
        return $this->hasManyThrough(TblSite::class, TblSiteCategory::class, 'category_id', 'site_id')->select(['category_id']);
    }

	/**
     * Get all of the posts for the country.
     */
    public function topic_sites()
    {
        return $this->belongsToMany(TblSite::class, 'tbl_site_categories', 'category_id', 'site_id')->where('crawl', 'active')->where('site_type', 'normal');
    }
}

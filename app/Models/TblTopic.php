<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use App\Models\TblTopicCategory as TopicCategory;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TblTopic
 * 
 * @property int $id
 * @property string $name
 * @property string $keywords
 * @property string $google_keywords
 * @property string $exclude_url
 * @property string $last_pastebin_key
 * @property string $last_public_pastebin
 *
 * @package App\Models
 */
class TblTopic extends Model
{
	protected $table = 'tbl_topics';
	protected $hidden = ['exclude_url', 'last_pastebin_key','last_public_pastebin','external'];
	public $timestamps = false;

	protected $fillable = [
		'name',
		'match_condition',
		'google_keywords',
		'external',
		'crawl_type',
		'event_lock'
	];

	/**
     * Get all of the posts for the country.
     */
    public function topic_categories()
    {
        return $this->hasMany(TblTopicCategory::class, 'topic_id');
	}
	

	/**
     * Get all of the topics for the department.
     */
    public function categories()
    {
        return $this->hasManyThrough(
			'App\Models\TblCategory', 
			'App\Models\TblTopicCategory',
			'topic_id', 
			'id', 
			'id', 
			'category_id'
		)->select(['category_id', 'name']);
	}
	
	public function departments()
    {
        return $this->belongsToMany(TblCategory::class, 'tbl_topic_categories', 'topic_id', 'category_id');
	}
}

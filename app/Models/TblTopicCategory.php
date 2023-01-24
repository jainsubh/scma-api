<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TblTopicCategory
 * 
 * @property int $id
 * @property int $topic_id
 * @property int $category_id
 *
 * @package App\Models
 */
class TblTopicCategory extends Model
{
	protected $table = 'tbl_topic_categories';
	protected $visible = ['category_id'];
	public $timestamps = false;

	protected $casts = [
		'topic_id' => 'int',
		'category_id' => 'int'
	];

	protected $fillable = [
		'topic_id',
		'category_id'
	];

	/**
     * Get all of the posts for the country.
     */
    public function categories()
    {
        return $this->belongsToMany(TblCategory::class, 'category_id')->select(['category_id', 'name']);
    }

	public function sites()
    {
        return $this->belongsToMany(TblSite::class);
    }
}

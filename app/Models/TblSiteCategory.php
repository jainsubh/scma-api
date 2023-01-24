<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TblSiteCategory
 * 
 * @property int $id
 * @property int $site_id
 * @property int $category_id
 *
 * @package App\Models
 */
class TblSiteCategory extends Model
{
	protected $table = 'tbl_site_categories';
	protected $visible = ['category_id'];
	public $timestamps = false;

	protected $casts = [
		'site_id' => 'int',
		'category_id' => 'int'
	];

	protected $fillable = [
		'site_id',
		'category_id'
	];

	/**
     * Get all of the posts for the country.
     */
    public function categories()
    {
        return $this->belongsToMany(TblCategory::class, 'category_id')->select(['category_id', 'name']);
    }
}

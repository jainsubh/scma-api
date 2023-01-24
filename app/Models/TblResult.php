<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblResult
 * 
 * @property int $id
 * @property int $site_id
 * @property int $topic_id
 * @property string $topic_name
 * @property int $category_id
 * @property string $url
 * @property string $keyword
 * @property string $content
 * @property int $occurence
 * @property string $title
 * @property Carbon $c_time
 * @property string $se_name
 * @property string $se_color
 * @property int $mail_status
 * @property string $release_date
 *
 * @package App\Models
 */
class TblResult extends Model
{
	protected $table = 'tbl_results';
	public $timestamps = false;

	protected $casts = [
		'site_id' => 'int',
		'topic_id' => 'int',
		'category_id' => 'int',
		'occurence' => 'int',
		'mail_status' => 'int'
	];

	protected $dates = [
		'c_time'
	];

	protected $fillable = [
		'site_id',
		'topic_id',
		'topic_name',
		'category_id',
		'url',
		'keyword',
		'content',
		'occurence',
		'title',
		'c_time',
		'se_name',
		'se_color',
		'mail_status',
		'release_date'
	];
}

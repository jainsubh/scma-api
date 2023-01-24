<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblPastebinResult
 * 
 * @property int $id
 * @property int $topic_id
 * @property string $topic_name
 * @property int $category_id
 * @property string $url
 * @property string $content
 * @property string $keyword
 * @property int $occurence
 * @property string $title
 * @property Carbon $c_time
 * @property string $se_name
 * @property string $se_color
 * @property int $mail_status
 *
 * @package App\Models
 */
class TblPastebinResult extends Model
{
	protected $table = 'tbl_pastebin_results';
	public $timestamps = false;

	protected $casts = [
		'topic_id' => 'int',
		'category_id' => 'int',
		'occurence' => 'int',
		'mail_status' => 'int'
	];

	protected $dates = [
		'c_time'
	];

	protected $fillable = [
		'topic_id',
		'topic_name',
		'category_id',
		'url',
		'content',
		'keyword',
		'occurence',
		'title',
		'c_time',
		'se_name',
		'se_color',
		'mail_status'
	];
}

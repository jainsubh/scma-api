<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblCrawlLog
 * 
 * @property int $id
 * @property string $description
 * @property Carbon $date_time
 *
 * @package App\Models
 */
class TblCrawlLog extends Model
{
	protected $table = 'tbl_crawl_logs';
	public $timestamps = false;

	protected $dates = [
		'date_time'
	];

	protected $fillable = [
		'description',
		'date_time'
	];
}

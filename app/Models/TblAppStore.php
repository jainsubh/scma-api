<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblAppStore
 * 
 * @property int $id
 * @property string $name
 * @property string $link
 * @property string $keyword
 * @property Carbon $datecreated
 * @property string $store_name
 *
 * @package App\Models
 */
class TblAppStore extends Model
{
	protected $table = 'tbl_app_store';
	public $timestamps = false;

	protected $dates = [
		'datecreated'
	];

	protected $fillable = [
		'name',
		'link',
		'keyword',
		'datecreated',
		'store_name'
	];
}

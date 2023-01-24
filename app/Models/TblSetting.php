<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblSetting
 * 
 * @property int $id
 * @property string $from_email
 * @property string $to_email
 * @property Carbon $created
 * @property Carbon $modeified
 *
 * @package App\Models
 */
class TblSetting extends Model
{
	protected $table = 'tbl_settings';
	public $timestamps = false;

	protected $dates = [
		'created',
		'modeified'
	];

	protected $fillable = [
		'from_email',
		'to_email',
		'created',
		'modeified'
	];
}

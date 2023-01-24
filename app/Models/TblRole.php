<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblRole
 * 
 * @property int $id
 * @property string $name
 * @property Carbon $created
 * @property Carbon $modified
 *
 * @package App\Models
 */
class TblRole extends Model
{
	protected $table = 'tbl_roles';
	public $timestamps = false;

	protected $dates = [
		'created',
		'modified'
	];

	protected $fillable = [
		'name',
		'created',
		'modified'
	];
}

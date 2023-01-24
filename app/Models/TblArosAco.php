<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TblArosAco
 * 
 * @property int $id
 * @property int $aro_id
 * @property int $aco_id
 * @property string $_create
 * @property string $_read
 * @property string $_update
 * @property string $_delete
 *
 * @package App\Models
 */
class TblArosAco extends Model
{
	protected $table = 'tbl_aros_acos';
	public $timestamps = false;

	protected $casts = [
		'aro_id' => 'int',
		'aco_id' => 'int'
	];

	protected $fillable = [
		'aro_id',
		'aco_id',
		'_create',
		'_read',
		'_update',
		'_delete'
	];
}

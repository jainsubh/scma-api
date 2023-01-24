<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TblAro
 * 
 * @property int $id
 * @property int $parent_id
 * @property string $model
 * @property int $foreign_key
 * @property string $alias
 * @property int $lft
 * @property int $rght
 *
 * @package App\Models
 */
class TblAro extends Model
{
	protected $table = 'tbl_aros';
	public $timestamps = false;

	protected $casts = [
		'parent_id' => 'int',
		'foreign_key' => 'int',
		'lft' => 'int',
		'rght' => 'int'
	];

	protected $fillable = [
		'parent_id',
		'model',
		'foreign_key',
		'alias',
		'lft',
		'rght'
	];
}

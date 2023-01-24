<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TblGlobal
 * 
 * @property int $id
 * @property string $name
 *
 * @package App\Models
 */
class TblGlobal extends Model
{
	protected $table = 'tbl_globals';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];
}

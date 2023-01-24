<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TblAppKeyword
 * 
 * @property int $id
 * @property string $name
 *
 * @package App\Models
 */
class TblAppKeyword extends Model
{
	protected $table = 'tbl_app_keywords';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];
}

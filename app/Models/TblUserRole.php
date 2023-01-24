<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TblUserRole
 * 
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 *
 * @package App\Models
 */
class TblUserRole extends Model
{
	protected $table = 'tbl_user_roles';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'role_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'role_id'
	];
}

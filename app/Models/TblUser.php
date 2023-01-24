<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblUser
 * 
 * @property int $id
 * @property string $access_token
 * @property string $name
 * @property string $email
 * @property string $mobile
 * @property string $username
 * @property string $password
 * @property int $role_id
 * @property string $status
 * @property string $admin_status
 * @property Carbon $created
 * @property Carbon $modified
 *
 * @package App\Models
 */
class TblUser extends Model
{
	protected $table = 'tbl_users';
	public $timestamps = false;

	protected $casts = [
		'role_id' => 'int'
	];

	protected $dates = [
		'created',
		'modified'
	];

	protected $hidden = [
		'access_token',
		'password'
	];

	protected $fillable = [
		'access_token',
		'name',
		'email',
		'mobile',
		'username',
		'password',
		'role_id',
		'status',
		'admin_status',
		'created',
		'modified'
	];
}

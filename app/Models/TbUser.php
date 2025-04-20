<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbUser
 * 
 * @property int $id
 * @property string|null $email
 * @property string $password
 * @property string|null $token
 * @property Carbon|null $created
 * @property string|null $hash_change_password
 *
 * @package App\Models
 */
class TbUser extends Model
{
	protected $table = 'tb_users';
	public $timestamps = false;

	protected $casts = [
		'created' => 'datetime'
	];

	protected $hidden = [
		'password',
		'token',
		'hash_change_password'
	];

	protected $fillable = [
		'email',
		'password',
		'token',
		'created',
		'hash_change_password'
	];
}

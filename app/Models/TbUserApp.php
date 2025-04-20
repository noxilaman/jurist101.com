<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbUserApp
 * 
 * @property int $id
 * @property int|null $user_id
 * @property int|null $app_id
 * @property Carbon|null $created
 * @property Carbon|null $last_login
 *
 * @package App\Models
 */
class TbUserApp extends Model
{
	protected $table = 'tb_user_app';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'app_id' => 'int',
		'created' => 'datetime',
		'last_login' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'app_id',
		'created',
		'last_login'
	];
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbSent
 * 
 * @property int $id
 * @property int|null $user_app_id
 * @property int|null $lawdata_id
 * @property string|null $email
 * @property string|null $contents
 * @property Carbon|null $created
 *
 * @package App\Models
 */
class TbSent extends Model
{
	protected $table = 'tb_sent';
	public $timestamps = false;

	protected $casts = [
		'user_app_id' => 'int',
		'lawdata_id' => 'int',
		'created' => 'datetime'
	];

	protected $fillable = [
		'user_app_id',
		'lawdata_id',
		'email',
		'contents',
		'created'
	];
}

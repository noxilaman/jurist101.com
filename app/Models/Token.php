<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Token
 * 
 * @property int $user_id
 * @property string $code
 * @property int $created_at
 * @property int $type
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Token extends Model
{
	protected $table = 'token';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'type' => 'int'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}

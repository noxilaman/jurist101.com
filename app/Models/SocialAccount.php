<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SocialAccount
 * 
 * @property int $id
 * @property int|null $user_id
 * @property string $provider
 * @property string $client_id
 * @property string|null $data
 * @property string|null $code
 * @property int|null $created_at
 * @property string|null $email
 * @property string|null $username
 * 
 * @property User|null $user
 *
 * @package App\Models
 */
class SocialAccount extends Model
{
	protected $table = 'social_account';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'provider',
		'client_id',
		'data',
		'code',
		'email',
		'username'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}

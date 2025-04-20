<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Profile
 * 
 * @property int $user_id
 * @property string|null $name
 * @property string|null $public_email
 * @property string|null $gravatar_email
 * @property string|null $gravatar_id
 * @property string|null $location
 * @property string|null $website
 * @property string|null $bio
 * @property string|null $timezone
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Profile extends Model
{
	protected $table = 'profile';
	protected $primaryKey = 'user_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'name',
		'public_email',
		'gravatar_email',
		'gravatar_id',
		'location',
		'website',
		'bio',
		'timezone'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * 
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property int|null $confirmed_at
 * @property string|null $unconfirmed_email
 * @property int|null $blocked_at
 * @property string|null $registration_ip
 * @property int $created_at
 * @property int $updated_at
 * @property int $flags
 * @property int|null $last_login_at
 * 
 * @property Profile $profile
 * @property Collection|SocialAccount[] $social_accounts
 * @property Collection|Token[] $tokens
 *
 * @package App\Models
 */

 class User extends Model implements AuthenticatableContract, JWTSubject
 {
	 use HasApiTokens,AuthenticableTrait;
	protected $table = 'users';

	protected $casts = [
		'confirmed_at' => 'int',
		'blocked_at' => 'int',
		'flags' => 'int',
		'last_login_at' => 'int'
	];

	protected $fillable = [
		'username',
		'email',
		'name',
		'password',
		'auth_key',
		'confirmed_at',
		'unconfirmed_email',
		'blocked_at',
		'registration_ip',
		'flags',
		'last_login_at',
		'i_role',
		'remember_token'
	];

	public function profile()
	{
		return $this->hasOne(Profile::class);
	}

	public function social_accounts()
	{
		return $this->hasMany(SocialAccount::class);
	}

	public function tokens()
	{
		return $this->hasMany(Token::class);
	}

	public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'i_role');
	}

	 public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

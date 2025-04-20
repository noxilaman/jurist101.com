<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WARNING
 * 
 * @property int $id
 * @property string|null $warning
 * @property string|null $website
 * @property string|null $token
 *
 * @package App\Models
 */
class WARNING extends Model
{
	protected $table = 'WARNING';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'warning',
		'website',
		'token'
	];
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbFavNote
 * 
 * @property int $id
 * @property int|null $user_app_id
 * @property int|null $lawdata_id
 * @property string|null $note
 * @property Carbon|null $created
 *
 * @package App\Models
 */
class TbFavNote extends Model
{
	protected $table = 'tb_fav_note';
	public $timestamps = false;

	protected $casts = [
		'user_app_id' => 'int',
		'lawdata_id' => 'int',
		'created' => 'datetime'
	];

	protected $fillable = [
		'user_app_id', 
		'lawdata_id',
		'note',
		'created'
	];
}

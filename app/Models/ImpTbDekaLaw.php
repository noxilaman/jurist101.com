<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ImpTbDekaLaw
 * 
 * @property int $id
 * @property int|null $lawdata_id
 * @property int|null $deka_id
 * @property int|null $order
 * @property Carbon|null $created
 *
 * @package App\Models
 */
class ImpTbDekaLaw extends Model
{
	protected $table = 'imp_tb_deka_law';
	public $timestamps = false;

	protected $casts = [
		'lawdata_id' => 'int',
		'deka_id' => 'int',
		'order' => 'int',
		'created' => 'datetime'
	];

	protected $fillable = [
		'lawdata_id',
		'deka_id',
		'order',
		'created'
	];
}

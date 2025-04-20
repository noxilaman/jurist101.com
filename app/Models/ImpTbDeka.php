<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImpTbDeka
 * 
 * @property int $id
 * @property int|null $i_no
 * @property int|null $i_subno
 * @property string|null $c_name
 * @property string|null $c_desc
 * @property string|null $c_comments
 *
 * @package App\Models
 */
class ImpTbDeka extends Model
{
	protected $table = 'imp_tb_deka';
	public $timestamps = false;

	protected $casts = [
		'i_no' => 'int',
		'i_subno' => 'int'
	];

	protected $fillable = [
		'i_no',
		'i_subno',
		'c_name',
		'c_desc',
		'c_comments'
	];
}

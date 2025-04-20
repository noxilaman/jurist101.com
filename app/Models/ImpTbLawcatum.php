<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImpTbLawcatum
 * 
 * @property int $id
 * @property int $i_id
 * @property int $i_no
 * @property int $i_subno
 * @property string|null $c_name
 * @property string|null $c_desc
 * @property string|null $c_comment
 * @property int|null $i_catlaw
 * @property int|null $i_lawno
 *
 * @package App\Models
 */
class ImpTbLawcatum extends Model
{
	protected $table = 'imp_tb_lawcata';
	public $timestamps = false;

	protected $casts = [
		'i_id' => 'int',
		'i_no' => 'int',
		'i_subno' => 'int',
		'i_catlaw' => 'int',
		'i_lawno' => 'int'
	];

	protected $fillable = [
		'i_id',
		'i_no',
		'i_subno',
		'c_name',
		'c_desc',
		'c_comment',
		'i_catlaw',
		'i_lawno'
	];
}

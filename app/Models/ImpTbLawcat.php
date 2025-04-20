<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImpTbLawcat
 * 
 * @property int $id
 * @property int $i_id
 * @property int $i_parent_id
 * @property int $i_seq
 * @property string $c_name
 * @property string $c_desc
 * @property int $i_level
 * @property string|null $c_law_code
 *
 * @package App\Models
 */
class ImpTbLawcat extends Model
{
	protected $table = 'imp_tb_lawcat';
	public $timestamps = false;

	protected $casts = [
		'i_id' => 'int',
		'i_parent_id' => 'int',
		'i_seq' => 'int',
		'i_level' => 'int'
	];

	protected $fillable = [
		'i_id',
		'i_parent_id',
		'i_seq',
		'c_name',
		'c_desc',
		'i_level',
		'c_law_code'
	];
}

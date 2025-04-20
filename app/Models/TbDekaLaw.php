<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbDekaLaw
 * 
 * @property int $id
 * @property int|null $lawdata_id
 * @property int|null $deka_id
 * @property int|null $order
 * @property Carbon|null $created
 *
 * @package App\Models
 */
class TbDekaLaw extends Model
{
	protected $table = 'tb_deka_law';
	public $timestamps = false;

	protected $casts = [
		'lawdata_id' => 'int',
		'deka_id' => 'int',
		'order' => 'int',
		'created' => 'datetime'
	];

	protected $fillable = [
		'lawdata_id', // lawdata id
		'deka_id', // deka id
		'order', // ลำดับ
		'created' // วันที่สร้าง
	];

	public function law()
    {
        return $this->hasOne('App\Models\TbLawdatum', 'i_id', 'lawdata_id');
    }

	public function deka()
    {
        return $this->hasOne('App\Models\TbDeka', 'id', 'deka_id');
    }
}

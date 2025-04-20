<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TbLawcat
 * 
 * @property int $i_id
 * @property int|null $app_id
 * @property int|null $i_parent_id
 * @property int|null $i_seq
 * @property string|null $c_name
 * @property string|null $c_desc
 * @property int|null $i_level
 * @property string|null $c_law_code
 *
 * @package App\Models
 */
class TbLawcat extends Model
{
	protected $table = 'tb_lawcat';
	protected $primaryKey = 'i_id';
	public $timestamps = false;

	protected $casts = [
		'app_id' => 'int',
		'i_parent_id' => 'int',
		'i_seq' => 'int',
		'i_level' => 'int'
	];

	protected $fillable = [
		'app_id', // รหัสแอพ
		'i_parent_id', // รหัสหมวดหมู่หลัก
		'i_seq', // ลำดับ
		'c_name', // ชื่อหมวดหมู่ 
		'c_desc',  // รายละเอียด
		'i_level', // ระดับ
		'c_law_code' // ข้อมูลมาตราอะไร ถึงอะไร note
	];

	public function mainlaw()
    {
        return $this->hasOne('App\Models\TbApp', 'id', 'app_id');
    }

	public function parentcat()
    {
        return $this->hasOne('App\Models\TbLawcat', 'i_id', 'i_parent_id');
    }

	public function subcats()
    {
        return $this->hasMany(TbLawcat::class,'i_parent_id');
    }

	public function laws()
    {
        return $this->hasMany(TbLawdatum::class,'i_lawcat');
    }
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TbLawdatum
 *
 * @property int $i_id
 * @property int|null $app_id
 * @property int|null $i_no
 * @property int|null $i_subno
 * @property string|null $c_name
 * @property string|null $c_desc
 * @property string|null $c_comment
 * @property string $c_url
 * @property int|null $i_lawcat
 * @property int|null $i_lawno
 *
 * @package App\Models
 */
class TbLawdatum extends Model
{
	protected $table = 'tb_lawdata';
	protected $primaryKey = 'i_id';
	public $timestamps = false;

	protected $casts = [
		'app_id' => 'int',
		'i_no' => 'int',
		'i_subno' => 'int',
		'i_lawcat' => 'int',
		'i_lawno' => 'int'
	];

	protected $fillable = [
		'app_id', // รหัสแอพ
		'i_no', // หมายเลขมาตรา
		'i_subno', // หมายเลขมาตราย่อย
		'c_name', // ชื่อมาตรา
		'c_desc', // รายละเอียดมาตรา
		'c_comment', // รายละเอียดเพิ่มเติม
		'c_url', // ลิงค์ที่เกี่ยวข้อง
		'i_lawcat', // id lawcat
		'i_lawno', // หมายเลขมาตรา
		'important_keys',
		'internal_factor', 
		'external_factor', //คำอธิบาย
		'short_note' // มาตราอย่างย่อ
	];

	public function mainlaw()
    {
        return $this->hasOne('App\Models\TbApp', 'id', 'app_id');
    }

	public function lawcat()
    {
        return $this->hasOne('App\Models\TbLawcat', 'i_id', 'i_lawcat');
    }

	public function dekalawlinks()
    {
        return $this->hasMany(TbDekaLaw::class,'lawdata_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'lawdata_id');
    }
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TbDeka
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
class TbDeka extends Model
{
	protected $table = 'tb_deka';
	public $timestamps = false;

	protected $casts = [
		'i_no' => 'int',
		'i_subno' => 'int'
	];

	protected $fillable = [
		'i_no', // เลขฎีกา
		'i_subno', // ปีฎีกา
		'c_name', // ชื่อฎีกา
		'c_desc', // รายละเอียดฎีกา
		'c_comments' // รายละเอียดเพิ่มเติม
	];

	public function dekalawlinks()
    {
        return $this->hasMany(TbDekaLaw::class,'deka_id');
    }
	
}

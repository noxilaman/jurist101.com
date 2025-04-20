<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TbApp
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $ios_id
 * @property string $app_desc
 * @property string $app_img
 * @property string $store_id
 * @property string|null $android_id
 * @property string|null $android_desc
 * @property string|null $android_store
 *
 * @package App\Models
 */
class TbApp extends Model
{
	protected $table = 'tb_app';
	public $timestamps = true;

	protected $fillable = [
		'name', // ชื่อแอพ
		'ios_id', // ios id
		'app_img', // รูปแอพ
		'store_id', // รหัสร้านค้า
		'android_id', // android id
		'android_store', //
		'app_desc', // คำอธิบายแอพ
		'android_desc', // คำอธิบายแอพ Andriod
		'group_app', // กลุ่มแอพ
		'icon_app', // ไอคอนแอพ
		'short_name', // ชื่อย่อ
		'version' // เวอร์ชั่น
	];
}

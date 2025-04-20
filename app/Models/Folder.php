<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // user id
        'parent_id', // parent id folder
        'level', // ระดับ
        'seq', // ลำดับ
        'name', // ชื่อ
        'status' // สถานะ
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function parent()
    {
        return $this->hasOne('App\Models\Folder', 'id', 'parent_id');
    }

	public function childs()
    {
        return $this->hasMany('App\Models\Folder','i_parent_id');
    }
}

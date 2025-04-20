<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keymap extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_id', // app id
        'key', // keyword
        'desc', // description
        'status' // สถานะ
    ];

	public function mainlaw()
    {
        return $this->hasOne('App\Models\TbApp', 'id', 'app_id');
    }

}

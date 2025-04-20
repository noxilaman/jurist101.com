<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $fillable = [
        'i_seq', // ลำดับ
        'name', // ชื่อคำถาม
        'detail', // รายละเอียดคำถาม
        'answer', // คำตอบ
        'comments',  // ความเห็น
        'lawdata_id' // lawdata id
    ];

    public function law()
    {
        return $this->hasOne('App\Models\TbLawdatum', 'i_id', 'lawdata_id');
    }
}

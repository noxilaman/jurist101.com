<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // user id
        'folder_id', // folder id
        'law_id', // law id
        'deka_id', // deka id
        'seq' // ลำดับ
    ]; 

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function folder()
    {
        return $this->hasOne('App\Models\Folder', 'id', 'folder_id');
    }

    public function law()
    {
        return $this->hasOne('App\Models\TbLawdatum', 'i_id', 'law_id');
    }

    public function deka()
    {
        return $this->hasOne('App\Models\TbDeka', 'id', 'deka_id');
    }

	public function notes()
    {
        return $this->hasMany('App\Models\Note','bookmark_id');
    }

}

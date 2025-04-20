<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bookmark_id',
        'start_index',
        'end_index',
        'select_word',
        'seq',
        'note'
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function bookmark()
    {
        return $this->hasOne('App\Models\Bookmark', 'id', 'bookmark_id');
    }
}

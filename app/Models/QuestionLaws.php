<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionLaws extends Model
{
    use HasFactory;
    protected $fillable = [
		'lawdata_id', // lawdata id
		'question_id', // question id
		'order' // ลำดับ
	];

    public function law()
    {
        return $this->hasOne('App\Models\TbLawdatum', 'i_id', 'lawdata_id');
    }

	public function question()
    {
        return $this->hasOne('App\Models\Question', 'id', 'question_id');
    }
}

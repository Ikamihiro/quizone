<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    protected $fillable = [
        'description',
        'correct',
        'question_id',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}

<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'correct',
    ];

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
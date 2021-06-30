<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
    ];

    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class, 'topic_questionnaire');
    }
}

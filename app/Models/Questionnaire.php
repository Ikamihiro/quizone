<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questionnaire extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
    ];

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'topic_questionnaire');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    /** @use HasFactory<\Database\Factories\ChallengeFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'vm_download_link',
        'difficulty',
        'points',
        'user_id',
        'scenario',
        'investigation_questions',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function challengeSubissions()
    {
        return $this->hasMany(ChallengeSubission::class);
    }
}

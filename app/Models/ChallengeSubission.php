<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallengeSubission extends Model
{
    /** @use HasFactory<\Database\Factories\ChallengeSubissionFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'challenge_id',
        'report_file_path',
        'status',
        'admin_feedback',
        'submitted_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
}

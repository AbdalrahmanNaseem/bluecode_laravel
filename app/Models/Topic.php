<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    /** @use HasFactory<\Database\Factories\TopicFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'lesson_id',
        'user_id',


    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lesson()
    {
        return $this->belongsTo(lesson::class);
    }
    public function question()
    {
        return $this->hasMany(Question::class);
    }
}

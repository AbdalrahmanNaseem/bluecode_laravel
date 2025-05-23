<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'user_id',
        'type',


    ];




    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lessons()
    {
        return $this->hasMany(lesson::class);
    }
}

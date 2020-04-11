<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'userid', 'place', 'details', 'country', 'genre', 'medium', 'cost', 'published'
    ];

    public function removes()
    {
        return $this->hasMany("App\PostDelete", "postid");
    }

    public function comments()
    {
        return $this->hasMany("App\Comment", "postid");
    }
}

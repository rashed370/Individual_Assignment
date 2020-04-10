<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostUpdate extends Model
{
    protected $fillable = [
        'postid', 'place', 'details', 'country', 'genre', 'medium', 'cost'
    ];

    public function post() {
        return $this->belongsTo("App\Post", "postid");
    }
}

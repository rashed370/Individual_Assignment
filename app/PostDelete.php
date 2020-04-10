<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostDelete extends Model
{
    protected $fillable = [
        'postid'
    ];

    public function post() {
        return $this->belongsTo("App\Post", "postid");
    }
}

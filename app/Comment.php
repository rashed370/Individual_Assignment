<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'userid', 'postid', 'comment'
    ];

    public function post() {
        return $this->belongsTo("App\Post", "postid");
    }

    public function user() {
        return $this->belongsTo("App\User", "userid");
    }
}

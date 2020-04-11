<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $fillable = [
        'userid', 'postid'
    ];

    public function post() {
        return $this->belongsTo("App\Post", "postid");
    }
}

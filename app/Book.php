<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        "unique", 
        "tag_id",
        "user_id",
        "title",
        "author",
        "description",
        "pageCount",
        "category",
        "image",
        "publisher",
        "pubDate"
    ];

    public function users() {

        return $this->belongsTo(User::class);
    }

     public function UserTags(){
        
        return $this->hasOne(UserTag::class);
    }
}

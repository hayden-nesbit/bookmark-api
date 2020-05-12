<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        "unique", 
        "tagId",
        "userId",
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
        
        return $this->belongsTo(UserTag::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        "unique", 
        "title",
        "author",
        "description",
        "pageCount",
        "pagesLeft",
        "category",
        "image",
        "publisher",
        "pubDate"
    ];

     public function UserTags(){
        
        return $this->belongsToMany("App\Tag", "user_tags", "book_id", "id");
    }
}

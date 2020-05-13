<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTag extends Model
{
    protected $fillable = [
        "user_id",
        "tag_id",
        "book_id",
    ];

    public function books() {

        return $this->belongsToMany("App\Book", "user_tags", "book_id");
    }

    public function tags() {

        return $this->belongsToMany("App\Tag", "user_tags", "tag_id");
    }

    public function users() {

        return $this->belongsToMany("App\User", "user_tags", "user_id");
    }

}

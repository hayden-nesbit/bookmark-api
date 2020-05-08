<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function users() {

        return $this->belongsTo(User::class);
    }

     public function UserTags(){
        
        return $this->belongsTo(UserTag::class);
    }
}

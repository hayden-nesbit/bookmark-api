<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTag extends Model
{
    public function users() {

        return $this->belongsTo(User::class);
    }

     public function books(){
        
        return $this->belongsToMany(Book::class);
    }
}

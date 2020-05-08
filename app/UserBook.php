<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBook extends Model
{
    public function users() {

        return $this->belongsTo(User::class);
    }

     public function books(){
        
        return $this->belongsTo(Book::class);

        //
    }
}

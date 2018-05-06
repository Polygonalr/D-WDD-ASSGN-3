<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Copy extends Model
{
    public function users(){
        return $this->hasMany("App\UserCopyLog");
    }

    public function book(){
        return $this->belongsTo("App\Book");
    }
}

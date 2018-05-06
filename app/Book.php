<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function author(){
        return $this->belongsTo("App\Author");
    }

    public function categories(){
        return $this->belongsToMany("App\Category");
    }

    public function copies(){
        return $this->hasMany("App\Copy");
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCopyLog extends Model
{
    public function user(){
        return $this->belongsTo("App\User");
    }
    public function copy(){
        return $this->belongsTo("App\Copy");
    }
}

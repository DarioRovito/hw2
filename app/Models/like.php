<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
   
    protected $table='likes';

     protected $primarykey ='id';
     public $timestamps = false;
     protected $autoincrement = false;
     protected $keytype = "string";

    public function User() {
        return $this->belongsTo("App\Models\User","id");
    }
 
    public function Post(){
        return $this->hasMany("App\Models\Post","user");
    }




}


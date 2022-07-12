<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table='users';  
     
    protected $primarykey ='id';
    public $timestamps = false;
    protected $fillable = [
      'username', 'password', 'email', 'name', 'surname', 'propic'
  ];

    public function posts() {
        return $this->hasMany("App\Models\Post","user","id");
    }

    public function comments() {
        return $this->hasMany('App\Models\Comment',"user","id");
    }

    public function likes() {
        return $this->belongsToMany('App\Models\Post', 'user',"id");
    }

    public function follow(){
        return $this->belongsToMany("App\Models\follow","idfollower",);
    }




}

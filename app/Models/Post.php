<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model {

    protected $table = 'posts';

    protected $primarykey ='id';
   public $timestamps = false;



protected $fillable=[   'user', 'type', 'content'
];

protected $casts = [
    'content' => 'array'
];

public function User() {
    return $this->belongsTo('App\Models\User','id','id');
}

public function likes() {
    return $this->belongsToMany('App\Models\like',"post","id");
}


public function comments() {
    return $this->hasMany('App\Models\Comment',"post","id");
}



}

?>
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    protected $table = 'comments';
    protected $primarykey ='id';
   public $timestamps = false;



    protected $fillable = [
        'user', 'post','text'
    ];


    protected $hidden = [
        'user', 'post'
    ];


    public function user() {
        return $this->belongsTo("App\Models\User","id");
    }

    public function post() {
        return $this->belongsTo("App\Models\Post","id");
    }
}

?>
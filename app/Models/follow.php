<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class follow extends Model
{
  protected $table='follow';
  protected $primaryKey = 'follower';
  public $timestamps = false;
  protected $autoincrement = false;
  protected $keytype = "string";

    protected $fillable = [
        "utente", "follower","idfollower"
    ];



}

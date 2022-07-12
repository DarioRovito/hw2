<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

Class mongodb extends Model{

protected $connection='mongodb';

protected $fillable = [
    'user', 'preferito'
];

public $timestamps = false;
}
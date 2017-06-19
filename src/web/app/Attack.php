<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attack extends Model
{
  /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = ['name', 'target', 'port', 'start', 'finish', 'bots_number'];

}

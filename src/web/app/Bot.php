<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
  /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = ['mac_address', 'name', 'cpu', 'operating_system', 'state'];
}

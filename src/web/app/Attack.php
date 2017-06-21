<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bot;

class Attack extends Model
{
  /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = ['name', 'target', 'port', 'start', 'finish', 'bots_number', 'duration'];


  public function bots()
  {
    return $this->hasMany('App\Bot');
  }

  /**
  * Get the user that create the attack.
  *
  * @return App\User;
  */
  public function user() {

   return $this->belongsTo('App\User');

  }

  /**
  * Get the attack's method.
  *
  * @return App\Method;
  */
  public function method() {

   return $this->belongsTo('App\Method');

  }
}

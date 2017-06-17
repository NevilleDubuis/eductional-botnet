<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
  ];

  /**
   * Liaison n:n avec users
   *
   * @var array
   */
   /*
   public function users() {

     return this->belongToMany('App\User');
   }
   */

}

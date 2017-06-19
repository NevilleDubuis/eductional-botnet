<?php

namespace App;

use App\Group;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  public function isAdmin () {
    return $this->admin;
  }

  /**
   * Liaison n:n avec groups
   *
   * @var array
   */
   public function groups()
   {
     return $this->belongsToMany('App\Group', 'users_groups', 'user_id', 'group_id');
   }

   /**
    * Liaison 1:n avec attacks
    *
    * @return App\Attack;
    */
    public function attacks()
    {
      return $this->hasMany('App\Attack');
    }



}

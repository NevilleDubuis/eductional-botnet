<?php

namespace App;

use App\User;

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
    'name', 'max_bot',
  ];

  /**
   * Liaison n:n avec users
   *
   * @return array
   */

   public function users()
   {
     return $this->belongsToMany('App\User', 'users_groups', 'group_id', 'user_id');
   }


}

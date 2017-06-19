<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
  /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = ['name'];

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

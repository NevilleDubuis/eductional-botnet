<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Attack;

class Bot extends Model
{
  /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = ['mac_address', 'name', 'cpu', 'operating_system', 'state'];

   public function needInformation()
   {
      return (!$this->name);
   }

   public function attack()
   {
     return $this->belongsTo('App\Attack', 'attack_id');
   }
}

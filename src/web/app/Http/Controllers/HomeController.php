<?php

namespace App\Http\Controllers;

use App\Repositories\AttackRepository;
use App\Repositories\BotRepository;

use Illuminate\Http\Request;

/**
 * [HomeController description]
 */
class HomeController extends Controller
{
  protected $attackRepository;
  protected $botRepository;


  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(AttackRepository $attackRepository, BotRepository $botRepository)
  {
    $this->middleware('auth');
    $this->attackRepository = $attackRepository;
    $this->botRepository = $botRepository;
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $attacks = $this->attackRepository->all();
    $bots = $this->botRepository->all();

    $runningAttacks = $this->attackRepository->running()->count();
    $waitingAttacks = $this->attackRepository->waiting()->count();
    $finishedAttacks = $this->attackRepository->finished()->count();

    $currentlyConnectedBots = $this->botRepository->currentlyConnected()->count();
    $attackingBots = $this->botRepository->attacking()->count();
    $disconnectedBots = $this->botRepository->disconnected()->count();

    return view('home',
            compact('attacks', 'bots',
                    'runningAttacks', 'waitingAttacks', 'finishedAttacks',
                    'currentlyConnectedBots', 'attackingBots', 'disconnectedBots'));
  }
}

<?php

namespace App\Http\Controllers;

use App\Repositories\AttackRepository;
use App\Repositories\BotRepository;

use Illuminate\Http\Request;

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
    return view('home', compact('attacks', 'bots', 'runningAttacks', 'waitingAttacks'));
  }
}

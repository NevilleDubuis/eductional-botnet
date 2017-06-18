<?php

namespace App\Http\Controllers;

use App\Bot;

use Illuminate\Http\Request;

use App\Repositories\BotRepository;

class BotsController extends Controller
{

  protected $botRepository;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct(BotRepository $botRepository)
   {
      $this->middleware('auth');
      $this->botRepository = $botRepository;
   }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $bots = $this->botRepository->all();

    return view('bots/index', compact('bots'));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Bot  $bot
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $bot = $this->botRepository->getById($id);
    return view('bots/show',  compact('bot'));
  }
}

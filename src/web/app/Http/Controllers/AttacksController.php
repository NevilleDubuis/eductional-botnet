<?php

namespace App\Http\Controllers;

use App\Attack;

use Illuminate\Http\Request;

use App\Repositories\AttackRepository;

class AttacksController extends Controller
{

  protected $attackRepository;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct(AttackRepository $attackRepository)
   {
      $this->middleware('auth');
      $this->attackRepository = $attackRepository;
   }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $attacks = Attack::with(array('user'))->get();

    return view('attacks/index', compact('attacks'));
  }
}

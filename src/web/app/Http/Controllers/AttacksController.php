<?php

namespace App\Http\Controllers;

use App\Attack;

use Illuminate\Http\Request;

use App\Repositories\AttackRepository;

class AttacksController extends Controller
{

  protected $attackRepository;
  protected $nbrPerPage = 5;

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
    $attacks = $this->attackRepository->getPaginate($this->nbrPerPage);

    return view('attacks/index', compact('attacks'));
  }
}

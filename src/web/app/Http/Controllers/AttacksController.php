<?php

namespace App\Http\Controllers;

use App\Attack;

use Illuminate\Http\Request;

use App\Repositories\AttackRepository;
use App\Repositories\MethodRepository;

use App\Http\Requests\AttackCreateRequest;

class AttacksController extends Controller
{

  protected $attackRepository;
  protected $methodRepository;
  protected $nbrPerPage = 10;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct(AttackRepository $attackRepository, MethodRepository $methodRepository)
   {
      $this->middleware('auth');
      $this->attackRepository = $attackRepository;
      $this->methodRepository = $methodRepository;
   }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $attacks = $this->attackRepository->getPaginate($this->nbrPerPage);
    $links = $attacks->setPath('')->render();

    return view('attacks/index', compact('attacks', 'links'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $methods = $this->methodRepository->all();

    return view('attacks/create', compact('methods'));
  }

  /**
  * Store information received by create form
  *
  * @param inputs from create form passed by request
  */
  public function store(AttackCreateRequest $request)
  {
    $this->attackRepository->store($request->all());

    return redirect()->route('attacks.index')->withOk("L'attaque a été créée.");
  }
}

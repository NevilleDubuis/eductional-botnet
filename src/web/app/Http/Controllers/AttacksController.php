<?php

namespace App\Http\Controllers;

use App\Attack;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    $currentUser = $this->getCurrentUser();
    $links = $attacks->setPath('')->render();

    return view('attacks/index', compact('attacks', 'links', 'currentUser'));
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
    $this->attackRepository->store($request->all(), $this->getCurrentUser());

    return redirect()->route('attacks.index')->withOk("L'attaque a été créée.");
  }

  /**
  * Delete attacks
  *
  * @return Response
  */

  public function destroy($id)
  {
    $this->attackRepository->destroy($id);
    return redirect()->route('attacks.index')->withOk("L'attaque a été supprimé.");
  }

  /**
  * Get the current user
  *
  * @return user
  */
  private function getCurrentUser() {
    return Auth::user();
  }

}

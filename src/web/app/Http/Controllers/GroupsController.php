<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\GroupRepository;

use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;

/**
 * [groupsController Gestion des groupes d'utilisateurs
 */
class groupsController extends Controller
{

  protected $groupRepository;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct(GroupRepository $groupRepository)
   {
      $this->middleware('auth');
      $this->groupRepository = $groupRepository;
   }

/**
 * Show the application dashboard.
 *
 * @return @return \Illuminate\Http\Response
 */
  public function index()
  {
    $this->checkAdmin();
    $groups = $this->groupRepository->getPaginate(parent::$nbrPerPage);
    $links = $groups->setPath('')->render();

    return view('groups/index', compact('groups', 'links'));
  }

  /**
   * Renvoie la vue d'édition d'un group
   *
   * @param  [type] $id ID du group à editer
   * @return [type]     Vue d'édition du group
   */
  public function edit($id)
  {
    $this->checkAdmin();
    $group = $this->groupRepository->getById($id);
    $users = $this->groupRepository->getUsers();

    return view('groups/edit',  compact('group', 'users'));
  }

  /**
   * Mise à jour des données d'un group
   *
   * @param  GroupUpdateRequest $request Class de validati
   * @param  [type]             $id      ID du group à faire l'update
   * @return [type]                      Vue Index avec message de confirmation
   */
  public function update(GroupUpdateRequest $request, $id)
  {
    $this->checkAdmin();
    $this->groupRepository->update($id, $request->all());

    return redirect()->route('groups.index')->withOk("Le groupe " . $request->input('name') . " a été modifié.");
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $this->checkAdmin();
    $users = $this->groupRepository->getUsers();

    return view('groups/create', compact('users'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(GroupCreateRequest $request)
  {
    $this->checkAdmin();
    $this->groupRepository->store($request->all());


    return redirect()->route('groups.index')->withOk("Le groupe a été créer.");
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $group = $this->groupRepository->getById($id);
    return view('groups.show',  compact('group'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $this->groupRepository->destroy($id);
    return redirect()->route('groups.index')->withOk("Le group a été supprimé.");
  }

  /**
   * Contrôle si le user connecté est un administrateur
   *
   * @return [bool] Rien si admin et abord si non admin
   */
  private function checkAdmin()
  {
    // check user permission
    $user = Auth::user();
    if (!$user->isAdmin()) {
      abort(404);
    }
  }
}

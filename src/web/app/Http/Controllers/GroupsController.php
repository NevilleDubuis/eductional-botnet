<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\GroupRepository;

use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;


class groupsController extends Controller
{

  protected $groupRepository;
  protected $nbrPerPage = 5;

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

  public function index()
  {
    $this->checkAdmin();
    $groups = $this->groupRepository->getPaginate($this->nbrPerPage);
    $links = $groups->setPath('')->render();

    return view('groups/index', compact('groups', 'links'));
  }

  public function edit($id)
  {
    $this->checkAdmin();
    $group = $this->groupRepository->getById($id);

    return view('groups/edit',  compact('group'));
  }

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
    $users = \App\User::all();

    return view('groups/create', compact('users'));
  }

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

  private function checkAdmin()
  {
    // check user permission
    $user = Auth::user();
    if (!$user->isAdmin()) {
      abort(404);
    }
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\GroupRepository;

use App\Http\Requests\GroupCreateRequest;


class groupsController extends Controller
{

  protected $groupRepository;
  protected $nbrPerPage = 10;

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

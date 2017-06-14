<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\GroupRepository;

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

  private function checkAdmin()
  {
    // check user permission
    $user = Auth::user();
    if (!$user->isAdmin()) {
      abort(404);
    }
  }
}

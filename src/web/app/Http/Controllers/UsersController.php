<?php

namespace App\Http\Controllers;

use App\Group;

use Illuminate\Http\Requests;
use Illuminate\Support\Facades\Auth;

use App\Repositories\UserRepository;
use App\Repositories\GroupRepository;

use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserCreateRequest;


class UsersController extends Controller
{

  protected $userRepository;
  protected $nbrPerPage = 5;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct(UserRepository $userRepository)
   {
      $this->middleware('auth');
      $this->userRepository = $userRepository;
   }


  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->checkAdmin();
    $users = $this->userRepository->getPaginate($this->nbrPerPage);
    $links = $users->setPath('')->render();

    return view('users/index', compact('users', 'links'));
  }

  /**
   * Lister les utilisateur selon un id de groupe
   *
   * @return
   */
  public function indexGroup($group) {
    $users = $this->userRepository->getWithGroupForPaginate($group, $this->nbrPerPage);
    $links = $users->render();

    return view('users.indexGroup', compact('users', 'links', 'group'));
  }

  public function edit($id)
  {
    $this->checkAdmin();
    $user = $this->userRepository->getById($id);

    return view('users/edit',  compact('user'));
  }

  public function update(UserUpdateRequest $request, $id)
  {
    $this->checkAdmin();
    $this->userRepository->update($id, $request->all());

    return redirect()->route('users.index')->withOk("L'utilisateur " . $request->input('name') . " a été modifié.");
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $this->checkAdmin();

    return view('users/create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(UserCreateRequest $request)
  {
    $this->checkAdmin();

    $this->userRepository->store($request->all());

    return redirect()->route('users.index')->withOk("L'utilisateur a été créer.");
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $user = $this->userRepository->getById($id);
    return view('users.show',  compact('user'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $this->userRepository->destroy($id);
    return redirect()->route('users.index')->withOk("L'utilisateur a été supprimé.");
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

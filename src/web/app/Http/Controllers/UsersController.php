<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;

use App\Http\Requests\UserUpdateRequest;

class UsersController extends Controller
{

  protected $userRepository;
  protected $nbrPerPage = 4;

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
      $user = Auth::user();
      if ($user->isAdmin()) {
        $users = $this->userRepository->getPaginate($this->nbrPerPage);
        $links = $users->setPath('')->render();
        return view('users/index', compact('users', 'links'));
      }
      else {
        return Response::html("", 404);
      }
  }

  public function edit($id)
  {
      $user = $this->userRepository->getById($id);

      return view('users/edit',  compact('user'));
  }

  public function update(UserUpdateRequest $request, $id)
  {
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
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
      //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
      //
  }

}

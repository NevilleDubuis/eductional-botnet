<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;

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

}

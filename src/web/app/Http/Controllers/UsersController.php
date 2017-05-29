<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User as User;

class UsersController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
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
        $users = User::all();
        return view('users/index')->withUsers($users);
      }
      else {
        return Response::html("", 404);
      }
  }
}

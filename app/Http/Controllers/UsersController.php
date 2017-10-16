<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\User;
use App\Mail\Welcome;

class UsersController extends Controller
{
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest', ['only' => ['store', 'login']]);
    }

    // Check whether user exists before registering
    public function precheck(Request $request)
    {
      $query = User::where('email', '=', $request->input('email'))->first();
      if ($query === null) {
        return "OPEN";
      } else {
        return "TAKEN";
      }
    }

    // Register new account
    protected function store(Request $request)
    {
      $name = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($request->input('user.name')))));
      $email = strtolower($request->input('user.email'));

      $user = User::create([
          'name' => $name,
          'email' => $email,
          'cell' => $request->input('user.cell'),
          'home' => $request->input('user.home'),
          'street' => $request->input('user.street'),
          'zip' => $request->input('user.zip'),
          'password' => Hash::make($request->input('user.pass'))
        ]);

        auth()->login($user);

        return User::where('email', $request->input('user.email'))->first()->id;
    }

    // Login functionality
    public function login(Request $request){
      if (!auth()->attempt(request(['email', 'password']))) {
        return 'INVALID';
      } else {
        return "VALID";
      }
    }

    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        //
    }


    public function update(Request $request, User $user)
    {

    }


    public function destroy(User $user)
    {
        //
    }

    public function logout(){
      auth()->logout();

      return redirect()->home();
    }

}

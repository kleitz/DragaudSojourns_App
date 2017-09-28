<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
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
          'password' => $request->input('user.password')
        ]);

        auth()->login($user);

        return User::where('email', $request->input('user.email'))->first()->id;
    }


    }

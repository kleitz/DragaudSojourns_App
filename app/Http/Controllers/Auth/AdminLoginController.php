<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest:admin', 'guest']);
    }

    public function showLoginForm()
    {
        return view('auth.admins.login');
    }

    public function precheck(Request $request)
    {
      $query = Admin::where('email', '=', $request->input('email'))->first();
      if ($query === null) {
        return "OPEN";
      } else {
        return "TAKEN";
      }
    }


    public function login(Request $request)
    {
      $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:6'
      ]);

      if (Auth::guard('admin')->attempt([
        'email' => $request->email,
        'password' => $request->password
      ], $request->remember)) {
            return redirect("/admin/" . auth('admin')->user()->email . "/dashboard");
      }

      return redirect()->back()->withInput($request->only('email', 'remember'))
          ->withErrors(["Your email or password are incorrect. Please try again with different credentials"]);
    }
}

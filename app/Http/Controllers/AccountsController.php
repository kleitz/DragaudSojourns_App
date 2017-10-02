<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Javascript;
use App\Traveler;

class AccountsController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function userUpdate(Request $request) {
      $curUser = auth()->user();
      $curUser->email = $request->input('user.email');
      $curUser->street = $request->input('user.street');
      $curUser->cell = $request->input('user.cell');
      $curUser->home = $request->input('user.home');
      $curUser->zip = $request->input('user.zip');

      $curUser->save();
      return "SUCCESS";
    }

    public function create($email)
    {
        $email =  Auth::user()->email;
        $authUsr = Auth::user();
        $authTravs = Traveler::where('user', Auth::user()->id)->get();
        return view('user.index', compact('authUsr', 'authTravs'));
    }
    public function createPayments($email)
    {
        $email =  Auth::user()->email;
        $authUsr = Auth::user();
        $authTravs = Traveler::where('user', Auth::user()->id)->get();
        return view('user.payments', compact('authUsr', 'authTravs'));
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Traveler  $traveler
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Traveler  $traveler
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Traveler  $traveler
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, User $user)
    {
        //
    }

    public function updateTravelers(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Traveler  $traveler
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

}

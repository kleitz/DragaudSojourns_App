<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Auth;
use Javascript;
use App\User;
use App\Group;
use App\Traveler;
use App\Coordinator;

class AccountsController extends Controller
{
    public $tripsPerPage = 4;
    public $paymentsPerPage = 10;

    public function __construct(){
      $this->middleware('auth', ['except' => 'show']);
    }

    public function userUpdate(Request $request) {
      $curUser = auth()->user();
      $curUser->name = $request->input('user.name');
      $curUser->email = $request->input('user.email');
      $curUser->street = $request->input('user.street');
      $curUser->cell = $request->input('user.cell');
      $curUser->home = $request->input('user.home');
      $curUser->zip = $request->input('user.zip');

      $curUser->save();
      return "SUCCESS";
    }

    public function confidentialUpdate(Request $request) {
      $curUser = auth()->user();
      $curUser->password = Hash::make($request->input('user.password'));
      $curUser->email = $request->input('user.email');

      $curUser->save();
      return "SUCCESS";
    }

    public function create($email)
    {
      $email =  Auth::user()->email;
      $trips = Auth::user()->trips()->orderBy('id', 'desc')->get();
      $numPages = ceil(count($trips) / $this->tripsPerPage);

      $authUsr = Auth::user();
      $authTrips = $trips->forPage(1, $this->tripsPerPage)->all();
      $authTravs = Auth::user()->travelers()->get();

      if (Auth::user()){
        return view('user.index', compact('authUsr', 'authTravs', 'authTrips' , 'numPages'));
      } else {
        return redirect('/');
      }
    }

    public function showPayments($email, $page)
    {
        $email =  Auth::user()->email;
        $payments = Auth::user()->payments()->orderBy('id', 'desc')->get();
        $numPages = ceil(count($payments) / $this->paymentsPerPage);

        $authUsr = Auth::user();
        $authTravs = Auth::user()->travelers()->get();
        $authPayments = $payments->forPage($page, $this->paymentsPerPage)->all();

        return view('user.payments', compact('authUsr', 'authTravs', 'authPayments', 'numPages'));
    }

    public function showTrips($email, $page) {
      $email =  Auth::user()->email;
      $trips = Auth::user()->trips()->orderBy('id', 'desc')->get();
      $numPages = ceil(count($trips) / $this->tripsPerPage);

      $authUsr = Auth::user();
      $authTrips = $trips->forPage($page, $this->tripsPerPage)->all();
      $authTravs = Auth::user()->travelers()->get();

      return view('user.index', compact('authUsr', 'authTravs', 'authTrips' , 'numPages'));
    }

    public function showGroups($email, $group) {
      $email = Auth::user()->email;
      $authCoords = Coordinator::where('user_id', '=', auth()->user()->id)->get();
      $authGroups = array();
      foreach ($authCoords as $coord) {
        $authGroups[] = Group::find($coord->group_id);
      }
      $authUsr = Auth::user();
      $authTravs = Auth::user()->travelers()->get();

      return view('user.groups', compact('authUsr', 'authTravs', 'authCoords', 'authGroups'));
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

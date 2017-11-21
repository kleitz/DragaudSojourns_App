<?php

namespace App\Http\Controllers;

use Auth;
use Password;
use App\Coordinator;
use App\User;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Notification;
use App\Notifications\NewGroupCoordinator;

class CoordinatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function precheck(Request $request)
    {
      $query = Coordinator::where('user_id', '=', $request->input('user_id'))
                    ->where('group_id', '=', $request->input('group_id') )->first();
      if ($query === null) {
        return "OPEN";
      } else {
        return "TAKEN";
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $reset_token = hash_hmac('sha256', Str::random(40), env('APP_KEY'));
      DB::table('password_resets')->insert([
          'email' => $request->input('user_email'),
          'token' => $reset_token,
          'created_at' => new Carbon,
      ]);

      $user = User::create([
        'name' => $request->input('user_name'),
        'email' => $request->input('user_email'),
        'cell' => $request->input('user_cell'),
        'home' => $request->input('user_home'),
        'street' => $request->input('user_street'),
        'zip' => $request->input('user_zip'),
        'password' => Hash::make(str_random(20))
      ]);

      $coordinator = Coordinator::create([
          'user_id' => $user->id,
          'group_id' => $request->input('group_id')
      ]);

      $group = Group::find($request->input('group_id'));

      Notification::route('mail', $request->input('user_email'))
      ->notify(new NewGroupCoordinator($reset_token, $request->input('user_email'), $user, $group));


      return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coordinator = Coordinator::create([
            'user_id' => $request->input('user_id'),
            'group_id' => $request->input('group_id')
        ]);

        $groupNum = $request->input('group_number');
        $email = Auth::guard('admin')->user()->email;
        return redirect("/admin/$email/group/$groupNum/coordinators");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coordinator  $coordinator
     * @return \Illuminate\Http\Response
     */
    public function show(Coordinator $coordinator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coordinator  $coordinator
     * @return \Illuminate\Http\Response
     */
    public function edit(Coordinator $coordinator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coordinator  $coordinator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coordinator $coordinator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coordinator  $coordinator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $coordinator = Coordinator::find($request->input('coord_id'));
        $coordinator->delete();

        return 'SUCCESS';
    }
}

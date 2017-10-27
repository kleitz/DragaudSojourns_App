<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Group;
use App\User;
use App\Trip;
use App\Traveler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminsController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($email)
    {
        $email = 'jjvannatta88';
        $trips = Trip::orderBy('id', 'desc')->get();
        $groups = Group::orderBy('number', 'asc')->get();
        // Groups shapshot
        $recentGroups = Group::orderBy('number', 'desc')->take(5)->get();

        // Accounts snapshot
        $signups = User::where('created_at', '>=', Carbon::now()->subMonth())->get();
        $accountSnapshot = new \stdClass();
        $accountSnapshot->signups = count($signups);
        $accountSnapshot->total = count(User::all());
        $accountSnapshot->travelers = count(Traveler::all());

        // Payments shapshot
        $paymentSnapshot = new \stdClass();
        $paymentSnapshot->total = 0;
        $paymentSnapshot->paid = 0;
        foreach ($trips as $trip){
          $paymentSnapshot->total += $trip->total;
          $paymentSnapshot->paid += $trip->paid;
        }

        $tripsSnapshot = array();
        foreach ($groups as $group){
          $groupTrips = DB::table('trips')
               ->join('groups', 'trips.group_id', '=', 'groups.id')
               ->select('groups.number', 'trips.total', 'trips.paid')
               ->where('group_id', $group->id)->get();
          $groupObj = new \stdClass();
          $groupObj->total = 0;
          $groupObj->paid = 0;
          $groupObj->travelers = 0;
          $groupObj->number = $group->number;
          foreach ($groupTrips as $gTrip) {
            $groupObj->total += $gTrip->total;
            $groupObj->paid += $gTrip->paid;
            $groupObj->travelers++;
          }
          $tripsSnapshot[] = $groupObj;
        }

        $authAdmin = $email;
        return view('admin.dashboard', compact('authAdmin', 'recentGroups', 'accountSnapshot', 'paymentSnapshot', 'tripsSnapshot'));
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

    public function storeIcon(Request $request)
    {
      $icon = $request->file('file');
      $iconName = pathinfo($icon->getClientOriginalName(), PATHINFO_FILENAME);
      $iconLoc = $iconName . 'TIME' .  time() . 'EXT.' . $icon->getClientOriginalExtension();
      $icon->storeAs('public/icons', $iconLoc);

      return 'storage/icons/' . $iconLoc;
    }

    public function destroyIcon(Request $request)
    {
      Storage::delete('public/icons/' . $request->input('icon'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}

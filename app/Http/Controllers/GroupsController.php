<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GroupsController extends Controller
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
    public function create()
    {
        return view('admin.creator');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $groupNum = $request->input('number');

      $icon = $request->file('icon');
      $iconName = pathinfo($icon->getClientOriginalName(), PATHINFO_FILENAME);
      $iconLoc = $iconName . 'TIME' .  time() . 'EXT.' . $icon->getClientOriginalExtension();
      $icon->storeAs('public/icons', $iconLoc);

      $itin = $request->file('itinerary');
      $itinLoc =  'dragaudcustomsojourns-' . $groupNum . '-itinerary.' . $itin->getClientOriginalExtension();
      $itin->storeAs('public/itineraries/'. $groupNum . '/', $itinLoc);

      $release = $request->file('release');
      $releaseLoc =  'dragaudcustomsojourns-terms-of-agreement.' . $release->getClientOriginalExtension();
      $release->storeAs('public/releases/' . $groupNum . '/', $releaseLoc);

      $group = Group::create([
          'number' => $groupNum,
          'destination' => $request->input('destination'),
          'depart' => $request->input('depart'),
          'return' => $request->input('return'),
          'school' => $request->input('school'),
          'packages' => $request->input('packages'),
          'icon' => 'storage/icons/' . $iconLoc,
          'itinerary' => 'storage/itineraries/' . $groupNum . '/' . $itinLoc,
          'release' => 'storage/releases/' . $groupNum . '/' . $releaseLoc,
          'message' => $request->input('message')
        ]);

        return view('admin.creator');
    }

    public function specific(Request $request){
      $bookingNum = $request->input('bookingNum');
      $group = Group::where('number', $bookingNum)->first();
      if ($group) {
        $group->packages = json_decode($group->packages);
      }

      return $group;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
}

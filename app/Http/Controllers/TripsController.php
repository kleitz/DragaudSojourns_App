<?php

namespace App\Http\Controllers;

use App\Trip;
use Illuminate\Http\Request;

class TripsController extends Controller
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
      $group = $request->input('group');
      $traveler = $request->input('traveler');

      $query = Trip::where('group_id', '=', $group)->get();

      if ($query->contains('traveler_id', $traveler)) {
        return "TAKEN";
      } else {
        return "OPEN";
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $trip = Trip::create([
          'group_id' => $request->input('trip.group'),
          'user_id' => $request->input('trip.user'),
          'traveler_id' => $request->input('trip.traveler'),
          'total' => $request->input('trip.total'),
          'insurance' => $request->input('trip.insurance'),
          'package' => $request->input('trip.package'),
          'paid' => 0.00,
          'active' => 1
        ]);

        return 'SUCCESS';
    }

    public function toggleActive(Request $request)
    {
        $trip = Trip::find($request->input('id'));
        $trip->active = $request->input('active');
        $trip->save();

        return $trip->active;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
     public function show(Trip $trip)
     {
         //
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        //
    }
}

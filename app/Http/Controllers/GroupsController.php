<?php

namespace App\Http\Controllers;

use Auth;
use App\Group;
use App\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use Elibyy\TCPDF\Facades\TCPDF;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function precheck(Request $request)
     {
       $query = Group::where('number', '=', $request->input('number'))->first();
       if ($query === null) {
         return "OPEN";
       } else {
         return "TAKEN";
       }
     }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $groupNum = $request->input('number');

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
          'icon' => $request->input('icon'),
          'itinerary' => 'storage/itineraries/' . $groupNum . '/' . $itinLoc,
          'release' => 'storage/releases/' . $groupNum . '/' . $releaseLoc,
          'message' => $request->input('message')
        ]);

        // $email =  Auth::admin()->email;
        $email = 'jjvannatta88';
        return redirect("/admin/$email/group/$groupNum");
    }

    public function specific(Request $request)
    {
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

    public function bookingReport($email, $group_id){

      $group = Group::find($group_id);
      $trips = $group->trips()->get();
      $admin = Admin::where('email', $email)->first();

      $view = \View::make('auth.receipts.bookingreport', compact('group', 'trips', 'admin'));

      $html = $view->render();

      $pdf = new TCPDF();

      $pdf::SetTitle($group->number . 'Booking Report');
      $pdf::AddPage();
      $pdf::writeHTML($html, true, false, true, false, '');

      $pdf::Output('dragaud_sojourns_receipt.pdf');
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
    public function update($group_id, $email, Request $request)
    {
        $group = Group::find($group_id);
        $number = $group->number;

        $group->destination = $request->input('destination');
        $group->depart = $request->input('depart');
        $group->return = $request->input('return');
        $group->school = $request->input('school');
        $group->packages = $request->input('packages');
        $group->message = $request->input('message');
        $group->icon = $request->input('icon');
        if ($request->file('itinerary') !== null) {
          $itin = $request->file('itinerary');
          $itinLoc =  'dragaudcustomsojourns-' . $number . '-itinerary.' . $itin->getClientOriginalExtension();
          $itin->storeAs('public/itineraries/'. $number . '/', $itinLoc);

          $group->itinerary = 'storage/itineraries/' . $number . '/' . $itinLoc;
        }
        if ($request->file('release') !== null) {
          $release = $request->file('release');
          $releaseLoc =  'dragaudcustomsojourns-terms-of-agreement.' . $release->getClientOriginalExtension();
          $release->storeAs('public/releases/' . $number . '/', $releaseLoc);

          $group->release = 'storage/releases/' . $number . '/' . $releaseLoc;
        }
        $group->save();

        return redirect("/admin/$email/group/$number");
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

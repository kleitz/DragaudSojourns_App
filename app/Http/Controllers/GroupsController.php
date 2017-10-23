<?php

namespace App\Http\Controllers;

use Auth;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
    public function create($email)
    {
      // $email =  Auth::admin()->email;
      $email = 'jjvannatta88';
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

        return redirect('/admin/jjvannatta88/groups/1');
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
    public $groupsPerPage = 10;

    public function show($email, $page)
    {
      // $email =  Auth::admin()->email;
      $email = 'jjvannatta88';
      $search = \Request::get('search');
      $groups = Group::orderBy('number', 'desc')->get();
      if ($search) {
        
        $destination = Group::where('destination', 'like', '%'.$search.'%');
        $school = Group::where('school', 'like', '%'.$search.'%');

        $groups = Group::where('number', 'like', '%'.$search.'%')
            ->union($destination)
            ->union($school)
            ->orderBy('id', 'desc')
            ->get();
      }
      $groupPages = ceil(count($groups) / $this->groupsPerPage);

      // $authAdmin = Auth::admin();
      $authAdmin = 'jjvannatta88';
      $authGroups = $groups->forPage($page, $this->groupsPerPage)->all();

      return view('admin.groups', compact('groupPages', 'authAdmin', 'authGroups'));
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

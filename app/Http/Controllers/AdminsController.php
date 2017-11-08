<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Admin;
use App\Group;
use App\User;
use App\Trip;
use App\Traveler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use Auth;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
       $this->middleware('auth:admin');
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($email)
    {
        $email =  Auth::guard('admin')->user()->email;
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
      * Display and search all group information
      * @param $email = authenticated admin
      * @param $page = sorted information by page
    */

    public $groupsPerPage = 10;
    public function groups($email, $page)
    {
      $email =  Auth::guard('admin')->user()->email;
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
      $numPages = ceil(count($groups) / $this->groupsPerPage);

      // $authAdmin = Auth::admin();
      $authAdmin = $email;
      $authGroups = $groups->forPage($page, $this->groupsPerPage)->all();

      return view('admin.groups', compact('numPages', 'authAdmin', 'authGroups'));
    }

    /**
      * Display and search all account information
      * @param $email = authenticated admin
      * @param $page = sorted information by page
    */

    public $accountsPerPage = 15;
    public function accounts($email, $page)
    {
      $email =  Auth::guard('admin')->user()->email;
      $search = \Request::get('search');
      $accounts = User::orderBy('id', 'desc')->get();
      if ($search) {

        $travelerAll = DB::table('users')
             ->join('travelers', 'users.id', '=', 'travelers.user_id')
             ->select('users.*')
             ->where('travelers.name', 'like', '%'.$search.'%');

        $scrubSearch = str_replace("'",  "", $search);
        $scrubSearch = str_replace('"',  "", $scrubSearch);
        $number = User::whereRaw("unix_timestamp(created_at) LIKE '%$scrubSearch%'");

        $accounts = User::where('name', 'like', '%'.$search.'%')
            ->union($number)
            ->union($travelerAll)
            ->orderBy('id', 'desc')
            ->get();
      }
      $numPages = ceil(count($accounts) / $this->accountsPerPage);

      // $authAdmin = Auth::admin();
      $authAdmin = $email;
      $authAccounts = $accounts->forPage($page, $this->accountsPerPage)->all();

      return view('admin.accounts', compact('numPages', 'authAdmin', 'authAccounts'));
    }

    /**
      * Display and search all payment information
      * @param $email = authenticated admin
      * @param $page = sorted information by page
    */

    public $paymentsPerPage = 1;
    public function payments($email, $page)
    {
      $email =  Auth::guard('admin')->user()->email;
      $search = \Request::get('search');
      $payments = Payment::orderBy('id', 'desc')->get();
      if ($search) {

        $travelerAll = DB::table('payments')
             ->join('trips', 'payments.trip_id', '=', 'trips.id')
             ->join('travelers', 'trips.traveler_id', '=', 'travelers.id')
             ->select('payments.*')
             ->where('name', 'like', '%'.$search.'%');

       $userAll = DB::table('payments')
            ->join('trips', 'payments.trip_id', '=', 'trips.id')
            ->join('users', 'trips.user_id', '=', 'users.id')
            ->select('payments.*')
            ->where('name', 'like', '%'.$search.'%');

      $groupAll = DB::table('payments')
           ->join('trips', 'payments.trip_id', '=', 'trips.id')
           ->join('groups', 'trips.group_id', '=', 'groups.id')
           ->select('payments.*')
           ->where('number', 'like', '%'.$search.'%');

        $payments = Payment::where('verification', 'like', '%'.$search.'%')
            ->union($travelerAll)
            ->union($userAll)
            ->union($groupAll)
            ->orderBy('id', 'desc')
            ->get();
      }
      $numPages = ceil(count($payments) / $this->paymentsPerPage);

      $authAdmin = $email;
      $authPayments = $payments->forPage($page, $this->paymentsPerPage)->all();

      return view('admin.payments', compact('numPages', 'authAdmin', 'authPayments'));
    }

    /**
      * Display all group specific information
      * @param $email = authenticated admin
      * @param $page = sorted information by page
    */


    public function groupOverview($email, $groupNumber)
    {
      $email =  Auth::guard('admin')->user()->email;
      $group = Group::where('number', $groupNumber)->first();
      $trips = $group->trips()->get();

      // $authAdmin = Auth::admin();
      $authAdmin = $email;
      return view('admin.group.overview', compact('group', 'trips', 'authAdmin'));
    }

    public function groupPayments($email, $groupNumber)
    {
      $email =  Auth::guard('admin')->user()->email;
      $group = Group::where('number', $groupNumber)->first();
      $payments = DB::table('payments')
           ->join('trips', 'payments.trip_id', '=', 'trips.id')
           ->join('groups', 'trips.group_id', '=', 'groups.id')
           ->select('payments.*', 'trips.group_id', 'trips.traveler_id', 'trips.user_id')
           ->where('number', '=', $groupNumber)
           ->orderBy('id', 'desc')->get();

      // $authAdmin = Auth::admin();
      $authAdmin = $email;
      return view('admin.group.payments', compact('group', 'payments', 'authAdmin'));
    }

    public function groupCreate($email)
    {
      // $email =  Auth::admin()->email;
      $email =  Auth::guard('admin')->user()->email;
      $authAdmin = $email;
      return view('admin.group.create', compact('authAdmin'));
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

    public function logout(Request $request)
   {
       auth('admin')->logout();
       $request->session()->flush();
       $request->session()->regenerate();
       return redirect('/');
   }
}

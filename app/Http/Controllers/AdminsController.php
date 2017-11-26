<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Admin;
use App\Group;
use App\User;
use App\Trip;
use App\Traveler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use Auth;

class AdminsController extends Controller
{

     public function __construct()
     {
       $this->middleware('auth:admin');
     }

    /**
     * Load admin dashboard
   */

    public function index($email)
    {
        $email =  Auth::guard('admin')->user()->email;
        $trips = Trip::orderBy('id', 'desc')->get();
        $payments = Payment::orderBy('id', 'desc')->get();
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
        }

        foreach ($payments as $payment) {
          $paymentSnapshot->paid += $payment->amount;
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

      $authAdmin = $email;
      $authAccounts = $accounts->forPage($page, $this->accountsPerPage)->all();

      return view('admin.accounts', compact('numPages', 'authAdmin', 'authAccounts'));
    }

    /**
      * Display and search all payment information
      * @param $email = authenticated admin
      * @param $page = sorted information by page
    */

    public $paymentsPerPage = 15;
    public function payments($email, $page)
    {
      $email =  Auth::guard('admin')->user()->email;
      $search = \Request::get('search');
      $dateIn = \Request::get('datefrom');
      $dateOut = \Request::get('dateto');
      $payments = Payment::orderBy('created_at', 'desc')->get();
      if ($search || $dateIn || $dateOut) {
        $dateS = explode("/", htmlspecialchars_decode($dateIn));
        $dateE = explode("/", htmlspecialchars_decode($dateOut));
        $dateFrom = \Carbon\Carbon::createFromDate($dateS[2], $dateS[0], $dateS[1]);
        $dateTo = \Carbon\Carbon::createFromDate($dateE[2], $dateE[0], $dateE[1]);

        $travelerAll = DB::table('payments')
             ->join('trips', 'payments.trip_id', '=', 'trips.id')
             ->join('travelers', 'trips.traveler_id', '=', 'travelers.id')
             ->select('payments.*')
             ->where('name', 'like', '%'.$search.'%')
             ->whereDate('payments.created_at', '>=', $dateFrom->toDateString())
             ->whereDate('payments.created_at', '<=', $dateTo->toDateString());

       $userAll = DB::table('payments')
              ->join('trips', 'payments.trip_id', '=', 'trips.id')
              ->join('users', 'trips.user_id', '=', 'users.id')
              ->select('payments.*')
              ->where('name', 'like', '%'.$search.'%')
              ->whereDate('payments.created_at', '>=', $dateFrom->toDateString())
              ->whereDate('payments.created_at', '<=', $dateTo->toDateString());

        $groupAll = DB::table('payments')
             ->join('trips', 'payments.trip_id', '=', 'trips.id')
             ->join('groups', 'trips.group_id', '=', 'groups.id')
             ->select('payments.*')
             ->where('number', 'like', '%'.$search.'%')
             ->whereDate('payments.created_at', '>=', $dateFrom->toDateString())
             ->whereDate('payments.created_at', '<=', $dateTo->toDateString());

        $payments = Payment::where('verification', 'like', '%'.$search.'%')
            ->whereDate('created_at', '>=', $dateFrom->toDateString())
            ->whereDate('created_at', '<=', $dateTo->toDateString())
            ->union($travelerAll)
            ->union($userAll)
            ->union($groupAll)
            ->orderBy('created_at', 'desc')
            ->get();
      }

      $numPages = ceil(count($payments) / $this->paymentsPerPage);
      $allPayments = $payments->all();
      $authAdmin = $email;
      $authPayments = $payments->forPage($page, $this->paymentsPerPage)->all();

      return view('admin.payments', compact('numPages', 'authAdmin', 'authPayments', 'allPayments'));
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

      $authAdmin = $email;
      return view('admin.group.payments', compact('group', 'payments', 'authAdmin'));
    }

    /**
      * Display all group coordinator information
      * @param $email = authenticated admin
      * @param $page = sorted information by page
    */

    public function groupCoordinators($email, $groupNumber)
    {
      $email =  Auth::guard('admin')->user()->email;
      $group = Group::where('number', $groupNumber)->first();
      $coordinators = $group->coordinators()->get();

      $authAdmin = $email;
      return view('admin.group.coordinators', compact('group', 'coordinators', 'authAdmin'));
    }

    /**
      * Display group creation page
      * @param $email = authenticated admin
    */

    public function groupCreate($email)
    {
      $email = Auth::guard('admin')->user()->email;
      $level = Auth::guard('admin')->user()->level;
      if ($level != 'System Administrator')
        return redirect("/admin/$email/dashboard");

      $authAdmin = $email;
      return view('admin.group.create', compact('authAdmin'));
    }

    /**
      * Display admin settings
      * @param $email = authenticated admin
    */

    public function settings($email)
    {
      $authAdmin = Auth::guard('admin')->user();
      return view('admin.settings.auth', compact('authAdmin'));
    }

    /**
      * Update admin profile details
    */

    public function update(Request $request)
    {
        $authAdmin = Auth::guard('admin')->user();
        $redirUrl = "/admin/$authAdmin->email/settings/";
        if ($request->has('admin_id')) {
          $authAdmin = Admin::find($request->input('admin_id'));
          $redirUrl = "/admin/$authAdmin->email/system/update/$authAdmin->id";
        }
        if (!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
          return redirect($redirUrl)
              ->withErrors(["<strong>Error!</strong> Could not update account. Email address must follow 'example@mail.com'"]);
        }

        if (strlen($request->input('name')) < 1) {
          return redirect($redirUrl)
              ->withErrors(["<strong>Error!</strong> Could not update account. User name is required"]);
        }

        $authAdmin->name = $request->input('name');
        if ($request->input('email') != $authAdmin->email)
          $authAdmin->email = $request->input('email');
        $authAdmin->level = $request->input('level');
        $authAdmin->save();
        return redirect($redirUrl)->with('message', 'Profile has been updated');
    }

    /**
      * Update admin password details
    */

    public function edit(Request $request)
    {
        $authAdmin = Auth::guard('admin')->user();
        $redirUrl = "/admin/$authAdmin->email/settings/";
        $altPass = false;
        $throughPass = '';
        $currPass = $request->input('current-pass');
        $newPass = $request->input('new-pass');
        $checkPass = $request->input('confirm-pass');

        if ($request->has('admin_id')) {
          $altPass = true;
          $checkPass = $request->input('new-pass');
          $authAdmin = Admin::find($request->input('admin_id'));
          $throughPass = $request->input('new-pass');
          $redirUrl = "/admin/$authAdmin->email/system/update/$authAdmin->id";
        }

        if (Hash::check($currPass, $authAdmin->password) || $altPass == true)
        {
          if ($newPass === $checkPass) {
            $uppercase = preg_match('@[A-Z]@', $newPass);
            $lowercase = preg_match('@[a-z]@', $newPass);
            $number    = preg_match('@[0-9]@', $newPass);

            if(!$uppercase || !$lowercase || !$number || strlen($newPass) < 8) {
              return redirect($redirUrl)
                  ->withErrors(["<strong>Error!</strong> Password must have at least 8 characters, include an uppercase letter, lowercase letter, and one number."]);
            }
            $authAdmin->password = Hash::make($newPass);
            $authAdmin->save();
            return redirect($redirUrl)->with('message', 'Password has been changed')->with('throughPass', $throughPass);
          }
          return redirect($redirUrl)
              ->withErrors(["<strong>Error!</strong> Could not update Password. The passwords do not match."]);
        }
        return redirect($redirUrl)
            ->withErrors(["<strong>Error!</strong> Could not update Password. The current password entered is incorrect"]);
    }

    /**
      * Admin create new admin
    */

    public function store(Request $request)
    {
      $authAdmin = Auth::guard('admin')->user();
      $tempPass = $request->input('password');
      $uppercase = preg_match('@[A-Z]@', $tempPass);
      $lowercase = preg_match('@[a-z]@', $tempPass);
      $number    = preg_match('@[0-9]@', $tempPass);
      if (strlen($request->input('name')) < 1 || strlen($request->input('email')) < 1 || strlen($request->input('password')) < 1) {
        return redirect("/admin/$authAdmin->email/settings/")
            ->withErrors(["<strong>Error: Could not create new admin. </strong><br/> All fields in 'Create new' are required to create a new administrator"]);
      }

      if (!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
        return redirect("/admin/$authAdmin->email/settings/")
            ->withErrors(["<strong>Error: Could not create new admin. </strong><br/>Email address must follow 'example@mail.com'"]);
      }

      if(!$uppercase || !$lowercase || !$number || strlen($tempPass) < 8) {
        return redirect("/admin/$authAdmin->email/settings/")
            ->withErrors(["<strong>Error: Could not create new admin. </strong><br/>Temporary password must have at least 8 characters, include an uppercase letter, lowercase letter, and one number."]);
      }

      $admin = Admin::create([
        'name' => $request->input('name'),
        'password' => Hash::make($tempPass),
        'email' => $request->input('email'),
        'level' => $request->input('level')
      ]);

      return redirect("/admin/$authAdmin->email/settings/")->with('message', 'New administrator has been created');

    }

    /**
      * System admin view specific admin
    */

    public function specific($email, $admin_id)
    {
      $authAdmin = Auth::guard('admin')->user();
        $specAdmin = Admin::find($admin_id);
      if ($authAdmin->level != 'System Administrator' || $authAdmin->id == $specAdmin->id)
        return redirect("/admin/$authAdmin->email/settings/");

      return view('admin.settings.specific', compact('authAdmin', 'specAdmin'));
    }

    /**
      * Admin delete admin account
    */

    public function destroy($admin_id)
    {
      $admin = Admin::find($admin_id);
      $authAdmin = Auth::guard('admin')->user();
      $admin->delete();
      return redirect("/admin/$authAdmin->email/settings/");
    }

    public function logout(Request $request)
   {
       auth('admin')->logout();
       $request->session()->flush();
       $request->session()->regenerate();
       return redirect('/');
   }
}

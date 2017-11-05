@extends('layouts.admin.master', [
	'title' => 'All Payments | Dragaud Custom Sojourns',
])

@section('content')
<?php
	$curUrl = explode("/", Request::url());
	$curPage = $curUrl[count($curUrl) - 1];
	$curSection = $curUrl[count($curUrl) - 2];
	if ($curPage < 1) {
		$curPage = 1;
	}
	$search = '';
	if (isset($_GET['search'])){
		$search = '?search=' . $_GET['search'];
	}
 ?>
<div id="payment-show-app" class="container admin-container">
<!-- PAYMENTS SEARCH RESULTS -->
<div class="col-xs-12 relative" style="z-index: 20">
  <div class="admin-floating-panel z-depth-2">
    <div class="flex-row-between">
      <div onclick="window.location='/admin/{{ $authAdmin }}/payments/1'" class="pointer">
        <h3 class="admin-section-header" >All payments</h3>
      </div>
    	<!-- SEARCH BAR -->
      @include('partials.admin.search')
    </div>
    <div class="row">
      <div class="col-xs-12">
				@include('partials.admin.pagination')
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 admin-show-table">
        <table class="table">
          <thead style="border-bottom: 10px solid white;">
            <tr>
              <th scope="col">Payment Id</th>
              <th scope="col">User Name</th>
              <th scope="col">Traveler</th>
              <th scope="col">Group #</th>
              <th scope="col">Amount</th>
              <th scope="col">Fee</th>
              <th scope="col">Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach($authPayments as $payment )
            <?php
              $trip = \App\Trip::where('id', $payment->trip_id)->first();
              $traveler = \App\Traveler::where('id', $trip->traveler_id)->first();
              $group = \App\Group::where('id', $trip->group_id)->first();
              $user = \App\User::where('id', $payment->user_id)->first();
             ?>
            <tr>
              <td class="show-td-l">
                <a href="/payments/receipts/{{ $payment->verification }}" target="_blank">{{ $payment->verification }}</a>
              </td>
              <td class="show-account-user flex-row-start">
                <a href="/admin/{{$authAdmin}}/accounts/1?search={{$user->name}}" href="javascript:;">{{ $user->name }}</a>
                <div class="relative admin-helper-modal hidden">
                  <div class="admin-helper">
                    <p>Account #: <strong>{{ $user->created_at->timestamp }}</strong> </p>
                    <p>Email: <strong>{{ $user->email }}</strong> </p>
                    <p>Home: <strong>{{ $user->home }}</strong></p>
                    <p>Cell: <strong>{{ $user->cell }}</strong></p>
                    <div class="flex-row-start">
                      <p>Address: </p>
                      <p><strong>{{ $user->street }}<br/>{{ $user->zip}}</strong></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="show-td-l">{{ $traveler->name }}</td>
              <td class="show-td-l">
                <a href="/admin/{{ $authAdmin }}/group/{{ $group->number }}">{{$group->number}}</a>
              </td>
              <td class="show-td-l">${{ $payment->amount }}</td>
              <td class="show-td-l">${{ $payment->fee }}</td>
              <td class="show-td-l">{{ $payment->created_at->format('m/d/y') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
				@if (count($authPayments) == 0)
					@include('partials.admin.noresults')
				@endif
      </div>
    </div>
    @include('partials.admin.pagebottom')
  </div>
</div>
<!-- END paymentS SEARCH  -->
</div>
@endsection

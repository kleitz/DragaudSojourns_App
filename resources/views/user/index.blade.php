
@extends('layouts.user.master', [
	'title' => auth()->user()->name . '\'s Profile | Dragaud Custom Sojourns',
	'header' => 'My Account'
])

@section('content')
	@include('partials.user.details')
	<div class="col-xs-9">
		<div class="row">
			<div class="col-xs-12">
				<h4 class="font-light">My Bookings:</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<ul class="nav nav-tabs ds-tabs">
				  <li class="nav-item">
				    <a class="nav-link tab-active" href="/profile/{{ auth()->user()->email }}">My Trips</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" href="/profile/{{ auth()->user()->email }}/payments/1">My Payments</a>
				  </li>
				</ul>
			</div>
			<div class="col-xs-12">
				@include('partials.user.trips')
			</div>
		</div>
	</div>
@endsection
<script>
let authUsr = {!! json_encode($authUsr->toArray()) !!};
let authTravs = {!! json_encode($authTravs) !!};
let authTrips = {!! json_encode($authTrips) !!};
let tripPayment = '';
</script>

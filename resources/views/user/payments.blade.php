@extends('layouts.user.master', [
	'title' => auth()->user()->name . '\'s Profile | Dragaud Custom Sojourns',
])

@section('content')
	@include('layouts.user.details')
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
					 <a class="nav-link" href="/profile/{{ auth()->user()->email }}">My Trips</a>
				 </li>
				 <li class="nav-item">
					 <a class="nav-link tab-active" href="/profile/{{ auth()->user()->email }}/payments/1">My Payments</a>
				 </li>
				</ul>
			</div>
			<div class="col-xs-12">
				@include('layouts.user.payments')
			</div>
		</div>
	</div>
@endsection
<script>
var authUsr = {!! json_encode($authUsr->toArray()) !!};
var authTravs = {!! json_encode($authTravs) !!};
var authPayments = {!! json_encode($authPayments) !!};
console.log(authPayments);
</script>

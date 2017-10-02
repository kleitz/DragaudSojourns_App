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
				    <a class="nav-link tab-active" href="/profile/{{ auth()->user()->email }}">My Trips</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" href="/profile/{{ auth()->user()->email }}/payments">My Payments</a>
				  </li>
				</ul>
			</div>
			<div class="col-xs-12">
				<nav aria-label="...">
				  <ul class="pagination pagination-sm">
				    <li class="page-item"><a class="page-link" href="#">1</a></li>
				    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
				    <li class="page-item"><a class="page-link" href="#">3</a></li> -->
				  </ul>
				</nav>
			</div>
		</div>
	</div>
@endsection
<script>
var authUsr = {!! json_encode($authUsr->toArray()) !!};
var authTravs = {!! json_encode($authTravs) !!};
</script>

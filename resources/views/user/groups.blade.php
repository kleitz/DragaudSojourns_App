
@extends('layouts.user.master', [
	'title' => auth()->user()->name . '\'s Profile | Dragaud Custom Sojourns',
	'header' => 'My Account'
])

<?php
	$curUrl = explode("/", Request::url());
	$curPage = $curUrl[count($curUrl) - 1];
	$curGroup = App\Group::where('number', '=', $curPage)->first();
 ?>

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
				    <a class="nav-link" href="/profile/{{ auth()->user()->email }}">My Trips</a>
				  </li>
					<li class="nav-item">
				    <a class="nav-link tab-active" href="/profile/{{ auth()->user()->email }}/groups/{{ $authGroups[0]->number }}">My Groups</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" href="/profile/{{ auth()->user()->email }}/payments/1">My Payments</a>
				  </li>
				</ul>
			</div>
			<div class="col-xs-12">
				 <!-- Group carousel -->
				  <div class="relative full-width">
				    @include('partials.user.groups.carousel')
				  </div>
				  <!-- Group description -->
				  <div class="relative full-width">
				    @include('partials.user.groups.description')
				  </div>
			</div>
		</div>
	</div>
@endsection
<script>
let authUsr = {!! json_encode($authUsr->toArray()) !!};
let authGroups = {!! json_encode($authGroups) !!};
let authCoords = {!! json_encode($authCoords) !!};
let authTravs = {!! json_encode($authTravs) !!};
</script>

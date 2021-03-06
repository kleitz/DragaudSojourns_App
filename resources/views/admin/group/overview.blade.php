@extends('layouts.admin.master', [
	'title' => 'Overview: Group ' . $group->number . ' | Dragaud Custom Sojourns',
])

@section('content')
<?php
	$iconList = [];
	$num = 0;
	foreach (glob("storage/icons/*") as $icon) {
		$iconList[$num] = $icon;
		$num++;
	}

	$systemLevel = true;
	if (\Auth::guard('admin')->user()->level != 'System Administrator')
		$systemLevel = false;
?>
<script>
// PHP VARIABLES -> JAVASCRIPT
	var iconListLoaded = {!! json_encode($iconList) !!};
</script>
<div class="container admin-container">
  <div class="col-xs-12 relative" style="z-index: 20">
    <div class="admin-split-panel z-depth-2">
			<div class="split-panel-header">
				<div onclick="window.location='/admin/{{ $authAdmin }}/group/{{ $group->number }}'" class="pointer">
	        <h3 class="admin-section-header" >Group details</h3>
	      </div>
				<nav class="split-panel-nav">
					<a class="split-panel-link active" href="/admin/{{ $authAdmin }}/group/{{ $group->number }}">Overview</a>
					<a class="split-panel-link" href="/admin/{{ $authAdmin }}/group/{{ $group->number }}/payments">Payments</a>
					<a class="split-panel-link" href="/admin/{{ $authAdmin }}/group/{{ $group->number }}/coordinators">Coordinators</a>
					<div id="group-nav-focus" class="split-nav-focus"></div>
				</nav>
			</div>
			<div class="split-panel-content">
				<div class="row">
					<div class="col-xs-4" id="group-focus-app">
						@include('partials.admin.group.focus')
					</div>
					<div class="col-xs-8" id="group-travelers-app">
						@if ($systemLevel)
						<div id="poverlay" class="dark-overlay-gen fix-fill hidden">
						</div>
						@include('partials.admin.group.adminPay')
						@endif
						<?php
							$tripsFixed = array();
							foreach ($trips as $trip) {
								$tripFixed = new \stdClass();
								$traveler = App\Traveler::where('id', $trip->traveler_id)->first();
								$user = App\User::where('id', $trip->user_id)->first();

								$tripFixed->id = $trip->id;
								$tripFixed->group_id = $trip->group_id;
								$tripFixed->active = $trip->active;
								$tripFixed->user = $user;
								$tripFixed->user->number = $user->created_at->timestamp;
								$tripFixed->traveler = $traveler;
								$tripFixed->package = $trip->package;
								$tripFixed->insurance = $trip->insurance;
								$tripFixed->paid = $trip->paid;
								$tripFixed->total = $trip->total;

								$tripsFixed[] = $tripFixed;
							}

							$groupDepart = false;
							$str = explode('/', $group->depart);
							$today = \Carbon\Carbon::now();
							$depart = \Carbon\Carbon::create($str[2], $str[0], $str[1], 0, 0, 0);
							if ($today->gte($depart)) {
								$groupDepart = true;
							}
						 ?>
						@include('partials.admin.group.travelers')
					</div>
				</div>
			</div>
    </div>
  </div>
</div>

<script type="text/javascript">
let groupLoaded = {!! json_encode($group) !!};
let groupDepart = {!! json_encode($groupDepart) !!};
let tripsLoaded = {!! json_encode($tripsFixed) !!};
let adminLoaded = {!! json_encode($authAdmin) !!};
</script>
<script src="/js/admin/groupFocus.js" type="text/javascript"></script>
<script src="/js/admin/groupOverview.js" type="text/javascript"></script>
@endsection

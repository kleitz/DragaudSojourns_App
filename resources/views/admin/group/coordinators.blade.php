@extends('layouts.admin.master', [
	'title' => 'Coordinators: Group ' . $group->number . ' | Dragaud Custom Sojourns',
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
					<a class="split-panel-link" href="/admin/{{ $authAdmin }}/group/{{ $group->number }}">Overview</a>
					<a class="split-panel-link" href="/admin/{{ $authAdmin }}/group/{{ $group->number }}/payments">Payments</a>
					<a class="split-panel-link active" href="/admin/{{ $authAdmin }}/group/{{ $group->number }}/coordinators">Coordinators</a>
					<div id="group-nav-focus" class="split-nav-focus"></div>
				</nav>
			</div>
			<div class="split-panel-content">
				<div class="row">
					<div class="col-xs-4" id="group-focus-app">
						@include('partials.admin.group.focus')
					</div>
					<div class="col-xs-8" id="group-coordinators-app">
					  @if ($systemLevel)
						<div id="coverlay" class="dark-overlay-gen fix-fill hidden">
						</div>
						@include('partials.admin.group.coordinatorMod')
						@endif
						<?php
							$coordinatorsLoaded = array();
							foreach ($coordinators as $coordinator) {
								$userData = App\User::where('id', $coordinator->user_id)->first();
								$loaded = new \stdClass();
								$loaded->user = $userData;
								$loaded->id = $coordinator->id;
								$loaded->created = $coordinator->created_at->format('m/d/Y');
								$coordinatorsLoaded[] = $loaded;
							}
						 ?>
						 @include('partials.admin.group.coordinators')
					</div>
				</div>
			</div>
    </div>
  </div>
</div>

<script type="text/javascript">
let groupLoaded = {!! json_encode($group) !!};
let coordinatorsLoaded = {!! json_encode($coordinatorsLoaded) !!};
let adminLoaded = {!! json_encode($authAdmin) !!};
</script>
<script src="/js/admin/groupFocus.js" type="text/javascript"></script>
<script src="/js/admin/groupCoordinators.js" type="text/javascript"></script>
@endsection

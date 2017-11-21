@extends('layouts.admin.master', [
	'title' => 'Group ' . $group->number . ' | Dragaud Custom Sojourns',
])

@section('content')
<?php
	$iconList = [];
	$num = 0;
	foreach (glob("storage/icons/*") as $icon) {
		$iconList[$num] = $icon;
		$num++;
	}
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
						<div id="goverlay" class="dark-overlay-gen fix-fill hidden" style="overflow-y: hidden">
							<!-- include icon picker -->
							<icon-select ref="iconselect" @close="hideIconSelect" @location="updateIconLoc" @name="updateIconName"></icon-select>
						</div>
						<div :class="{'gpanel-expand z-depth-2' : groupEdit == true, 'panel panel-secure border-panel-light gpanel' : true}">
							<div class="panel-heading">
								<div class="flex-row-between">
									<h5 style="margin: 7px 0; font-weight: 300">Group @{{ groupIn.number }}</h5>
									<a href="javascript:;" class="gfocus-button ds-button button-cancel" v-if="groupEdit == false" @click="emitEdit">Edit</a>
									<a href="javascript:;" class="gfocus-button ds-button gc-delete" v-if="groupEdit == true" @click="cancelEdit">Cancel</a>
								</div>
							</div>
							<div class="panel-body gfocus-body">
								<div v-if="groupEdit == false">
									@include('partials.admin.group.before')
								</div>
								<div v-if="groupEdit == true">
									@include('partials.admin.group.after')
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-8" id="group-coordinators-app">
						<div id="coverlay" class="dark-overlay-gen fix-fill hidden">
						</div>
						@include('partials.admin.group.coordinatorMod')
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
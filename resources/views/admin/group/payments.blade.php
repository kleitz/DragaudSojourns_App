@extends('layouts.admin.master', [
	'title' => 'Payments: Group ' . $group->number . ' | Dragaud Custom Sojourns',
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
					<a class="split-panel-link active" href="/admin/{{ $authAdmin }}/group/{{ $group->number }}/payments">Payments</a>
					<a class="split-panel-link" href="/admin/{{ $authAdmin }}/group/{{ $group->number }}/coordinators">Coordinators</a>
					<div id="group-nav-focus" class="split-nav-focus"></div>
				</nav>
			</div>
			<div class="split-panel-content">
				<div class="row">
					<div class="col-xs-4" id="group-focus-app">
						@include('partials.admin.group.focus')
					</div>
					<div class="col-xs-8" id="group-payments-app">
						<?php
							$paymentsFixed = array();
							$groupDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $group->created_at)->format('m/d/Y');

							foreach ($payments as $payment) {
								$paymentFixed = new \stdClass();
								$traveler = App\Traveler::where('id', $payment->traveler_id)->first();
								$user = App\User::where('id', $payment->user_id)->first();
								$paymentFixed->user = $user;
								$paymentFixed->user->number = $user->created_at->timestamp;
								$paymentFixed->traveler = $traveler;
								$paymentFixed->verification = $payment->verification;
								$paymentFixed->amount = $payment->amount;
								$paymentFixed->fee = $payment->fee;
								$paymentFixed->date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $payment->created_at)->format('m/d/Y');

								$paymentsFixed[] = $paymentFixed;
							}
						 ?>
						 @include('partials.admin.group.payments')
					</div>
				</div>
			</div>
    </div>
  </div>
</div>

<script type="text/javascript">
let authAdmin = {!! json_encode($authAdmin) !!};
let groupLoaded = {!! json_encode($group) !!};
let groupDate = {!! json_encode($groupDate) !!};
let paymentsLoaded = {!! json_encode($paymentsFixed) !!};
</script>
<script src="/js/admin/groupFocus.js" type="text/javascript"></script>
<script src="/js/admin/groupPayments.js" type="text/javascript"></script>
@endsection

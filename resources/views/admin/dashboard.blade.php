@extends('layouts.admin.master', [
	'title' => 'Dashboard | Dragaud Custom Sojourns',
])

@section('content')
<?php
	$seasons = array();
	$seasonGroups = new \stdClass();
	foreach ($tripsSnapshot as $group) {
		$season = substr($group->number, 0, 2);
		if (!in_array($season, $seasons)){
			$seasons[] = $season;
			$seasonGroups->{$season}[] = $group;
		} else {
			$seasonGroups->{$season}[] = $group;
		}
	}
	function nice_number($n) {
			$n = (0+str_replace(",", "", $n));
			if (!is_numeric($n)) return false;
			if ($n > 1000000000000) return round(($n/1000000000000), 1).'T';
			elseif ($n > 1000000000) return round(($n/1000000000), 1).'B';
			elseif ($n > 1000000) return round(($n/1000000), 1).'M';
			elseif ($n > 1000) return round(($n/1000), 0).'K';
			return number_format($n);
	}
?>
<div id="dashboard-app" class="container admin-container">
  <!-- GROUPS SUMMARY -->
  <div class="col-xs-12 relative" style="z-index: 20">
		@include('partials.admin.dashboard.summary')
  </div>
  <!-- GROUP SNAPSHOT -->
  <div class="col-xs-7">
		@include('partials.admin.dashboard.groups')
  </div>
  <div class="col-xs-5">
    <div class="row">
      <!-- PAYMENTS SNAPSHOT -->
      <div class="col-xs-12">
				@include('partials.admin.dashboard.payments')
      </div>
      <!-- ACCOUNTS SNAPSHOT -->
      <div class="col-xs-12">
				@include('partials.admin.dashboard.accounts')
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
let paymentLoaded = {!! json_encode($paymentSnapshot) !!};
let tripsLoaded = {!! json_encode($tripsSnapshot) !!};
let seasonsLoaded = {!! json_encode($seasons) !!};
let groupsLoaded = {!! json_encode($seasonGroups) !!};

let summaryChartData = '';
let paymentCfg = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
							paymentLoaded.paid,
							paymentLoaded.total - paymentLoaded.paid,
            ],
            backgroundColor: [
							"#73b8c4",
              "#aad7de",
            ],
            label: 'Total revenue',
						pointHoverBackgroundColor: "#73b8c4",
        }],
        labels: [
				  "Captured",
          "Remaining",
        ]
    },
    options: {
			tooltips: {
						 enabled: true,
						 mode: 'single',
						 callbacks: {
								 label: function(tooltipItems, data) {
										let index = tooltipItems.index;
										let label = data.labels[index];
										let amount = data.datasets[0].data[index];
										if (amount > 1000000000000) {
											amount = Math.round((amount/1000000000000), 1) + 't';
										} else if (amount > 1000000000) {
											amount =  Math.round((amount/1000000000), 1) + 'b';
										} else if (amount > 1000000) {
											amount =  Math.round((amount/1000000), 1) + 'm';
										} else if (amount > 1000) {
											amount =  Math.round((amount/1000), 0) + 'k';
										}
										return label + ': $' + amount;
								 }
						 }
				 },
				cutoutPercentage: 80,
        responsive: true,
        legend: {
						display: false,
            position: 'bottom',
        },
        title: {
            display: false,
            text: 'Total revenue'
        },
        animation: {
            animateScale: false,
            animateRotate: true
        }
    }
};

$(document).ready(function(){
	var paymentCtx = document.getElementById("payments-chart").getContext('2d');
	window.paymentSnapshot = new Chart(paymentCtx, paymentCfg);
});
</script>
<script src="/js/admin/dashboard.js" type="text/javascript"></script>
@endsection

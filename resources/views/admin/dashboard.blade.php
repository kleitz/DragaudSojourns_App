@extends('layouts.admin.master', [
	'title' => 'Dashboard | Dragaud Custom Sojourns',
])

@section('content')
<div id="dashboard-app" class="container admin-container">
  <!-- GROUPS SUMMARY -->
  <div class="col-xs-12 relative" style="z-index: 20">
    <div class="admin-floating-panel z-depth-2">
			<div class="row">
				<div class="col-xs-4">
					<div onclick="window.location='/admin/{{ $authAdmin }}/dashboard'" class="pointer">
		        <h3 class="admin-section-header" style="margin-bottom: 0">Summary</h3>
		      </div>
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
					?>
					<div class="flex-row-start" style="margin-bottom: 30px">
						<h4 class="admin-section-subtext" style="margin: 0">for the</h4>
						<div class="material-input-group dashboard-select" style="padding: 0 50px 0 0;">
							<select @change="selectSeason" class="custom-select form-control material-input" name="traveler">
								<option v-for="season in seasons" :value="season" > 20@{{ season }} season</option>
							</select>
						</div>
					</div>
					<div class="flex-row-start" style="margin-bottom: 15px">
						<div class="summary-key travelers"></div>
            <h4 class="admin-section-subheader flex-self-centered" style="margin: 0 5px 0 0">@{{ activeDetails.travelers }}</h4>
            <h4 class="admin-section-subtext flex-self-centered" style="margin: 10px 0 10px 0; font-size: 20px">custom trips arranged</h4>
          </div>
					<div class="flex-row-start" style="margin-bottom: 15px">
						<div class="summary-key projected"></div>
            <h4 class="admin-section-subheader flex-self-centered" style="margin: 0 5px 0 0">$@{{ parseFloat(activeDetails.captured).toLocaleString('en') }}</h4>
            <h4 class="admin-section-subtext flex-self-centered" style="margin: 10px 0 10px 0; font-size: 20px">in projected revenue</h4>
          </div>
					<div class="flex-row-start" style="margin-bottom: 15px">
						<div class="summary-key captured"></div>
            <h4 class="admin-section-subheader flex-self-centered" style="margin: 0 5px 0 0">$@{{ parseFloat(activeDetails.projected).toLocaleString('en') }}</h4>
            <h4 class="admin-section-subtext flex-self-centered" style="margin: 10px 0 10px 0; font-size: 20px">in captured revenue</h4>
          </div>
				</div>
				<div class="col-xs-8" style="margin-top: 30px;">
					<div id="summary-chart-container">

					</div>
					<div class="flex-row-between chart-scubbers" style="height: 30px;">
						<div>
							<a v-if="chartScrub > 0" href="javascript:;" @click="scrubLeft"><i class="fa fa-caret-left" aria-hidden="true"></i></a>
						</div>
						<div class="">
							<a v-if="chartScrub + scrubLen < groupLen" href="javascript:;" @click="scrubRight"><i class="fa fa-caret-right" aria-hidden="true"></i></a>
						</div>
					</div>
				</div>
			</div>
    </div>
  </div>
  <!-- GROUP SNAPSHOT -->
  <div class="col-xs-7">
    <div class="admin-floating-panel z-depth-2">
      <div onclick="window.location='/admin/{{ $authAdmin }}/groups/1'" class="pointer">
        <h4 class="admin-section-subheader" style="margin-bottom: 0">Recent groups</h4>
      </div>
      <div class="row">
        <div class="col-xs-12 admin-show-table" style="min-height: auto;">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Number</th>
                <th scope="col">Details</th>
                <th scope="col">Progress</th>
              </tr>
            </thead>
            <tbody>
              @foreach($recentGroups as $group )
              <?php
                $trips = $group->trips()->get();
                $len = count($trips);
                $total = 0;
                $paid = 0;
                if ($len > 0) {
                  for ($i = 0; $i < $len; $i++ ) {
                    $total += $trips[$i]->total;
                    $paid += $trips[$i]->paid;
                  }
                } else {
                  $total = 1;
                }

                $progress = floor($paid / $total * 100);
                $tripClass = 'progress-good';
                if ($progress < 60 && $progress > 30) {
                  $tripClass = 'progress-safe';
                } else if ($progress < 30) {
                  $tripClass = 'progress-warning';
                }

                $str = explode('/', $group->depart);
                $today = \Carbon\Carbon::now();
                $depart = \Carbon\Carbon::create($str[2], $str[0], $str[1], 0, 0, 0);

                if ($progress < 100 && $today->gte($depart))
                  $tripClass = 'progress-hazard';
               ?>
              <tr>
                <td scope="row">
                  <div class="flex-abs-center group-show-icon relative">
                    @if ($tripClass == 'progress-hazard')
                    <div class="group-hazard-icon absolute">
                      <small class="abs-center">!</small>
                    </div>
                    @endif
                    <div class="show-icon-container">
                      <img src="/{{ $group->icon }}" alt="">
                    </div>
                    <a href="/admin/{{ $authAdmin }}/group/{{ $group->number }}">{{$group->number}}</a>
                  </div>
                </td>
                <td class="{{ $tripClass }}" >{{ $group->depart }}: {{ $group->destination }}</td>
                 <td style="width: 200px">
                   <div class="group-progress flex-abs-center">
                     <div class="progress-bar">
                       <div class="progress-bar-bg"></div>
                       <div class="progress-bar-fg {{ $tripClass }}"></div>
                     </div>
                     <p class="progress-bar-stat">{{ $progress . '%' }}</p>
                   </div>
                 </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <a href="/admin/{{ $authAdmin }}/groups/1" class="admin-feature-link"><span>+</span> See all groups</a>
        </div>
      </div>

    </div>
  </div>
  <div class="col-xs-5">
    <div class="row">
      <!-- PAYMENTS SNAPSHOT -->
			<?php
			    function nice_number($n) {
			        // first strip any formatting;
			        $n = (0+str_replace(",", "", $n));

			        // is this a number?
			        if (!is_numeric($n)) return false;

			        // now filter it;
			        if ($n > 1000000000000) return round(($n/1000000000000), 1).'T';
			        elseif ($n > 1000000000) return round(($n/1000000000), 1).'B';
			        elseif ($n > 1000000) return round(($n/1000000), 1).'M';
			        elseif ($n > 1000) return round(($n/1000), 0).'K';

			        return number_format($n);
			    }
			?>
      <div class="col-xs-12">
        <div class="admin-floating-panel z-depth-2">
					<div class="row">
						<div class="col-xs-6 relative" style="padding: 0">
							<div class="abs-center">
								<h3 class="admin-section-subheader relative" style="z-index: 2; margin: 0; top: 8px">${{ nice_number($paymentSnapshot->total) }}</h3>
								<p class="admin-section-subtext" style="font-size: 18px">total revenue</p>
							</div>
							<canvas id="payments-chart" width="400" height="400"></canvas>
						</div>
						<div class="col-xs-6">
							<h4 class="admin-section-subheader" style="margin: 15px 0 0 ">${{ number_format($paymentSnapshot->paid) }}</h4>
							<div class="flex-row-start">
								<div class="payment-key captured"></div><h5 class="admin-section-subtext" style="margin: 0 0 15px">captured</h5>
							</div>
							<h4 class="admin-section-subheader" style="margin: 0">${{ number_format($paymentSnapshot->total)  }}</h4>
							<div class="flex-row-start">
								<div class="payment-key projected"></div><h5 class="admin-section-subtext" style="margin: 0 0 33px">projected</h5>
							</div>
						</div>
					</div>
					<a href="/admin/{{ $authAdmin }}/payments/1" class="admin-feature-link"><span>+</span> See all payments</a>
        </div>
      </div>
      <!-- ACCOUNTS SNAPSHOT -->
      <div class="col-xs-12">
        <div class="admin-floating-panel z-depth-2">
          <div class="flex-row-start">
            <h4 class="admin-section-subheader flex-self-centered" style="margin: 0 15px 0 0">{{ $accountSnapshot->signups }}</h4>
            <h4 class="admin-section-subtext flex-self-centered" style="margin: 10px 0 10px 0">signups in the last month</h4>
          </div>
          <div class="flex-row-start">
            <h4 class="admin-section-subheader flex-self-centered" style="margin: 0 15px 0 0">{{ $accountSnapshot->total }}</h4>
            <h4 class="admin-section-subtext flex-self-centered" style="margin: 10px 0 10px 0">total accounts created</h4>
          </div>
          <div class="flex-row-start">
            <h4 class="admin-section-subheader flex-self-centered" style="margin: 0 15px 0 0">{{ $accountSnapshot->travelers }}</h4>
            <h4 class="admin-section-subtext flex-self-centered" style="margin: 10px 0 10px 0">unique travelers</h4>
          </div>
          <a href="/admin/{{ $authAdmin }}/accounts/1" class="admin-feature-link"><span>+</span> See all accounts</a>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

let paymentLoaded = {!! json_encode($paymentSnapshot) !!};
let tripsLoaded = {!! json_encode($tripsSnapshot) !!};
let seasonsLoaded = {!! json_encode($seasons) !!};
let groupsLoaded = {!! json_encode($seasonGroups) !!};

console.log(groupsLoaded);
let summaryChartData = '';
</script>
<script src="/js/admin/dashboard.js" type="text/javascript"></script>
<script type="text/javascript">

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
				  "captured",
          "remaining",
        ]
    },
    options: {
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
@endsection

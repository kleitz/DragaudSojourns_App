<div class="row admin-payments-analytics full-width">
  <div class="col-xs-3 full-height">
    <div class="row">
      <div class="col-xs-1"> </div>
      <div class="col-xs-9">
        <canvas id="panalytics-chart" width="400" height="400"></canvas>
      </div>
    </div>
  </div>
  <div class="col-xs-4 relative">
    <table class="table admin-panalytics-table">
      <thead style="border-bottom: 10px solid white;">
        <tr>
          <th width="40%" scope="col"><strong>Method</strong></th>
          <th width="30%" scope="col"><strong>Count</strong></th>
          <th width="30%" scope="col"><strong>Amount</strong></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td width="40%" class="show-td-l flex-row-start full-width">
            <div class="panalytics-node blue"></div>
            <p style="margin: 0">Credit</p>
          </th>
          <td width="30%" class="show-td-l">{{ $analyticsChart->credit }}</th>
          <td width="30%" class="show-td-l">${{ number_format($analytics->credit) }}</th>
        </tr>
        <tr>
          <td width="40%" class="show-td-l flex-row-start full-width">
            <div class="panalytics-node green"></div>
            <p style="margin: 0">Paypal</p>
          </th>
          <td width="30%" class="show-td-l">{{ $analyticsChart->paypal }}</th>
          <td width="30%" class="show-td-l">${{ number_format($analytics->paypal) }}</th>
        </tr>
        <tr>
          <td width="40%" class="show-td-l flex-row-start full-width">
            <div class="panalytics-node gold"></div>
            <p style="margin: 0">Check</p>
          </th>
          <td width="30%" class="show-td-l">{{ $analyticsChart->check }}</th>
          <td width="30%" class="show-td-l">${{ number_format($analytics->check) }}</th>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-xs-5 full-height">
    <div class="flex-col-around full-height" style="padding-right: 50px">
      <div class="admin-panalytics-total flex-row-start">
        <div class="col-xs-6">
          <h4 class="ds-blue">${{ number_format($analytics->total) }}</h4>
        </div>
        <div class="col-xs-6">
          <label>Payments</label>
          <p>Over period</p>
        </div>
      </div>
      <div class="admin-panalytics-total" style='border-bottom: 0'>
        <div class="col-xs-6">
          <h4 class="ds-trueblue">${{ number_format($analytics->fees) }}</h4>
        </div>
        <div class="col-xs-6">
          <label>Processing fees</label>
          <p>Over period</p>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
let summaryChartData = '';
let paymentCfg = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
							analyticsChart.credit,
							analyticsChart.paypal,
              analyticsChart.check
            ],
            backgroundColor: [
							"#559dad",
              "#6fc99d",
              "#cb9853",
            ],
            label: 'Total revenue',
						pointHoverBackgroundColor: "#73b8c4",
        }],
        labels: [
				  "Credit",
          "Paypal",
          "Check"
        ]
    },
    options: {
			tooltips: {
						 enabled: true,
						 mode: 'single',
				 },
				cutoutPercentage: 60,
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
	var paymentCtx = document.getElementById("panalytics-chart").getContext('2d');
	window.paymentSnapshot = new Chart(paymentCtx, paymentCfg);
});
</script>

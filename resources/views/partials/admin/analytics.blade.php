<div id="admin-payment-analytics" class="row admin-payments-analytics full-width static">
  <div class="col-xs-3 full-height">
    <div class="row full-height">
      <div class="col-xs-1"> </div>
      <div class="col-xs-9 relative full-height">
        <div class="abs-fill">
          <div class="abs-center flex-col-start">
            <h4 class="text-center admin-section-subheader no-margin">{{
                number_format($analyticsChart->credit + $analyticsChart->paypal + $analyticsChart->check)
             }}</h4>
             <h5 class="text-center admin-section-subtext subtext-close no-margin">payments</h5>
          </div>
        </div>
        <div class="full-height flex-abs-center">
          <canvas id="panalytics-chart" width="400" height="400"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-4 relative full-height flex-col-center">
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
    <div class="col-xs-1"></div>
    <div class="flex-col-around full-height col-xs-11" style="padding-right: 50px">
      <div class="admin-panalytics-total flex-row-start">
        <div class="col-xs-6">
          <h4 class="ds-blue text-right">${{ number_format($analytics->total) }}</h4>
        </div>
        <div class="col-xs-6">
          <label>Total income</label>
          <p>Over period</p>
        </div>
      </div>
      <div class="admin-panalytics-total" style='border-bottom: 0'>
        <div class="col-xs-6">
          <h4 class="ds-trueblue text-right">${{ number_format($analytics->fees) }}</h4>
        </div>
        <div class="col-xs-6">
          <label>Processing fees</label>
          <p>Over period</p>
        </div>
      </div>
    </div>
  </div>
</div>

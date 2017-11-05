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

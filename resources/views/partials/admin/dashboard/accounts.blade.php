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

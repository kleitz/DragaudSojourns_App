<label class="gfocus-label">Destination</label>
<p>@{{ groupIn.destination }} </p>
<label class="gfocus-label">Icon</label>
<div class="gfocus-icon-container flex-row-start">
  <p class="gfocus-icon pointer" href="javascript:;">@{{ iconDisplay }}</p>
  <div id="gfocus-icon-show" class="admin-helper-modal hidden">
    <div class="admin-helper absolute helper-icon-img">
      <img :src="'/' + groupIn.icon" width="80px" height="80px"/>
    </div>
  </div>
</div>
<label class="gfocus-label">Packages</label>
<p v-for="package in groupPackages">@{{package.name}}: $@{{package.cost}}</p>
<div class="row">
  <div class="col-xs-5">
    <label class="gfocus-label">Depart</label>
    <p>@{{ groupIn.depart }} </p>
  </div>
  <div class="col-xs-5">
    <label class="gfocus-label">Return</label>
    <p>@{{ groupIn.return }} </p>
  </div>
</div>
<label class="gfocus-label">School</label>
<p>@{{ groupIn.school }} </p>
<label class="gfocus-label">Message</label>
<p style="font-size: 16px">@{{ groupIn.message }}... </p>
<a href="/admin/{{ $authAdmin }}/report/{{ $group->id }}" target="_blank" class="gfocus-link" ><i class="material-icons">arrow_downward</i>Download booking report</a>

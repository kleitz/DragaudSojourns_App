<div class="admin-floating-panel z-depth-2">
  <div class="row">
    <div class="col-xs-4">
      <div onclick="window.location='/admin/{{ $authAdmin }}/dashboard'" class="pointer">
        <h3 class="admin-section-header" style="margin-bottom: 0">Summary</h3>
      </div>
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
        <h4 class="admin-section-subheader flex-self-centered" style="margin: 0 5px 0 0">$@{{ parseFloat(activeDetails.projected).toLocaleString('en') }}</h4>
        <h4 class="admin-section-subtext flex-self-centered" style="margin: 10px 0 10px 0; font-size: 20px">in projected revenue</h4>
      </div>
      <div class="flex-row-start" style="margin-bottom: 15px">
        <div class="summary-key captured"></div>
        <h4 class="admin-section-subheader flex-self-centered" style="margin: 0 5px 0 0">$@{{ parseFloat(activeDetails.captured).toLocaleString('en') }}</h4>
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

<div class="panel panel-secure border-panel-light">
  <div class="panel-heading">
    <h5 style="margin: 7px 0; font-weight: 300">Travelers</h5>
  </div>
  <div class="panel-table-header">
    <table>
      <thead>
        <tr>
          <td width="200px">Traveler</td>
          <td width="143px">Package</td>
          <td width="148px">Balance</td>
          <td width="96px">Insurance</td>
          <td width="67px" style="padding:15px 12px 10px">Active</td>
        </tr>
      </thead>
    </table>
  </div>
  <div class="panel-table-content clearfix">
    <table>
      <tbody>
        <tr v-for="trip, index in trips">
          <td class="show-account-user flex-row-start" style="width: 101%">
            <a class="dot-dot-dot" :href="'/admin/' + admin + '/accounts/1?search=' + trip.traveler.name" style="max-width: 165px">@{{ trip.traveler.name }}</a>
            <div class="relative admin-helper-modal hidden">
              <div class="admin-helper fix-helper">
                <small>Details</small>
                <p>Birth date: <strong>@{{ trip.traveler.dob }}</strong> </p>
                <p>Gender: <strong>@{{ trip.traveler.gender }}</strong> </p>
                <p v-if="trip.traveler.relationship == 'Myself'" >Account owner</p>
                <p v-if="trip.traveler.relationship != 'Myself'">@{{ trip.traveler.relationship }}: <strong> @{{ trip.user.name }}</strong> </p>
                <small>Emergency</small>
                <p>Name: <strong>@{{ trip.traveler.emerg_name }}</strong> </p>
                <p>Phone: <strong>@{{ trip.traveler.emerg_phone }}</strong> </p>
              </div>
            </div>
          </td>
          <td class="" width="150px">
            <del class="del-content"v-if="trip.active == 0">@{{ trip.package }}</del>
            <div v-if="trip.active == 1">@{{ trip.package }}</div>
          </td>
          <td width="150px" style="padding: 7px 8px 6px 20px">
            <del class="del-content"v-if="trip.active == 0"style="font-size: 18px; margin: 0 0 5px">$@{{ trip.total - trip.paid }}</del>
            <div v-if="trip.active == 1" :class="{'flex-row-between': true, 'color-hazard' : (depart == true && trip.total - trip.paid != 0) }">
              <div class="flex-row-start relative">
                <p>$@{{ trip.total - trip.paid }}</p>
                <div :class="{ 'relative' : true, 'hidden' : (depart != true && trip.total - trip.paid == 0) }">
                  <div v-if="depart == true && trip.total - trip.paid != 0" class="group-hazard-icon absolute" style="left: 0; top: 0; transform:scale(0.8) ">
                    <small class="abs-center">!</small>
                  </div>
                </div>
              </div>
              <button type="button" name="newtrip" class="button-cancel gc-button go-button" @click="adminPayment(index)">+</button>
            </div>
          </td>
          <td class="" width="100px">
            <del class="del-content"v-if="trip.active == 0">@{{ trip.insurance }}</del>
            <div v-if="trip.active == 1">@{{ trip.insurance }}</div>
          </td>
          <td width="68px" style="padding: 0 5px">
            <label class="status-switch">
              <input type="checkbox" :checked="trip.active == 1" @click="toggleActive(index)">
              <span class="status-slider status-round"></span>
            </label>
          </td>
        </tr>
        @if (count($trips) < 9)
          @for ($i = 0; $i < 9 - count($trips) ; $i++)
          <tr>
            <td width="200px"style="color: transparent;font-size: 20px">null</td>
            <td width="142px"style="color: transparent;font-size: 20px">null</td>
            <td width="149px"style="color: transparent;font-size: 20px">null</td>
            <td width="97px"style="color: transparent;font-size: 20px">null</td>
            <td width="68px"style="color: transparent;font-size: 20px">null</td>
          </tr>
          @endfor
        @endif
      </tbody>
    </table>
  </div>
</div>

<div class="panel panel-secure border-panel-light">
  <div class="panel-heading">
    <h5 style="margin: 7px 0; font-weight: 300">Coordinators</h5>
  </div>
  <div class="panel-table-header">
    <table>
      <thead>
        <tr>
          <td width="30%" scope="col">User</td>
          <td width="30%" scope="col">Email</td>
          <td width="20%" scope="col">Date added</td>
          <td width="20%" scope="col">Modify</td>
        </tr>
      </thead>
    </table>
  </div>
  <div class="panel-table-content clearfix">
    <table>
      <tbody>
        <tr v-for="coordinator, index in coordinators">
          <td width="30%">
            <div class="show-account-user flex-row-start" >
              <a class="dot-dot-dot" :href="'/admin/' + admin + '/accounts/1?search=' + coordinator.user.name" style="max-width: 165px">@{{ coordinator.user.name }}</a>
              <div class="relative admin-helper-modal hidden">
                <div class="admin-helper fix-helper">
                  <p>Home: <strong>@{{ coordinator.user.home }}</strong></p>
                  <p>Cell: <strong>@{{ coordinator.user.cell }}</strong></p>
                  <div class="flex-row-start">
                    <p>Address: </p>
                    <p><strong>@{{ coordinator.user.street }}<br/>@{{ coordinator.user.zip }}</strong></p>
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td width="30%" class="">
            @{{ coordinator.user.email }}
          </td>
          <td width="20%">
            @{{ coordinator.created }}
          </td>
          <td width="20%" class="">
            <a href="javascript:;" class="gfocus-button ds-button button-cancel auto-width" @click="removeCoordinator(index)">Remove</a>
          </td>
        </tr>
        <tr>
          <td width="30%">--</td>
          <td width="30%">--</td>
          <td width="20%">--</td>
          <td width="20%">
            <a href="javascript:;" class="gfocus-button ds-button button-cancel auto-width" style="padding: 5px 12px" @click="newCoordinator">Add new</a>
          </td>
        </tr>
        @if (count($coordinators) < 8)
          @for ($i = 0; $i < 8 - count($coordinators) ; $i++)
          <tr>
            <td width="30%" style="color: transparent;font-size: 20px;">null</td>
            <td width="30%" style="color: transparent;font-size: 20px">null</td>
            <td width="20%" style="color: transparent;font-size: 20px">null</td>
            <td width="20%" style="color: transparent;font-size: 20px">null</td>
          </tr>
          @endfor
        @endif
      </tbody>
    </table>
  </div>
</div>

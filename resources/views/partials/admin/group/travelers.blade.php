<div class="panel panel-secure border-panel-light">
  <div class="panel-heading">
    <h5 style="margin: 7px 0; font-weight: 300">Travelers</h5>
  </div>
  <div class="panel-table-header">
    <table>
      <thead>
        <tr>
          <td width="35%">Traveler</td>
          <td width="25%">Package</td>
          <td width="20%">Balance</td>
          <td width="20%">Insurance</td>
        </tr>
      </thead>
    </table>
  </div>
  <div class="panel-table-content clearfix">
    <table>
      <tbody>
        @foreach ($trips as $trip)
        <?php
          $traveler = App\Traveler::where('id', $trip->traveler_id)->first();
          $user = App\User::where('id', $trip->user_id)->first();
         ?>
        <tr>
          <td class="show-account-user flex-row-start" style="width: 100%">
            <a href="/admin/{{$authAdmin}}/accounts/1?search={{$traveler->name}}" href="javascript:;">{{ $traveler->name }}</a>
            <div class="relative admin-helper-modal hidden">
              <div class="admin-helper fix-helper">
                <small>Account</small>
                <p>User: <strong>{{ $user->name }}</strong> </p>
                <p>Account #: <strong>{{ $user->created_at->timestamp }}</strong> </p>
                <p>Email: <strong>{{ $user->email }}</strong> </p>
                <small>Emergency</small>
                <p>Name: <strong>{{ $traveler->emerg_name }}</strong> </p>
                <p>Phone: <strong>{{ $traveler->emerg_phone }}</strong> </p>
              </div>
            </div>
          </td>
          <td width="25%">{{ $trip->package }}</td>
          <td width="20%">${{ number_format($trip->total - $trip->paid, 2) }}</td>
          <td width="20%">{{ $trip->insurance }}</td>
        </tr>
        @endforeach
        @if (count($trips) < 9)
          @for ($i = 0; $i < 9 - count($trips) ; $i++)
          <tr>
            <td width="35%"style="color: transparent;font-size: 20px">null</td>
            <td width="25%"style="color: transparent;font-size: 20px">null</td>
            <td width="20%"style="color: transparent;font-size: 20px">null</td>
            <td width="20%"style="color: transparent;font-size: 20px">null</td>
          </tr>
          @endfor
        @endif
      </tbody>
    </table>
  </div>
</div>

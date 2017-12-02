<div class="full-card" style="margin: 15px 0 30px; padding: 15px 5px 30px">
  <div class="row" style="margin:0">
    <div class="col-xs-12" style="padding: 0 10px" >
      <h4 class="font-light">Signups</h4>
    </div>
    <div class="col-xs-12" style="padding: 0 10px" >
      <table class="table coordinator-trips-table z-depth-custom relative" style="margin: 0 0 -1px; z-index: 15">
        <thead>
          <tr style="background: #e7e8ea;">
            <th width="25%" style="border: 0">TRAVELER NAME</th>
            <th width="20%" style="border: 0">EMERGENCY</th>
            <th width="20%" style="border: 0">PHONE</th>
            <th width="17%" style="border: 0">BALANCE</th>
            <th width="18%" style="border: 0">ACCOUNT</th>
          </tr>
        </thead>
      </table>
      <div class="relative scrollbar-subtle coordinator-trips-container">
        <table class='table coordinator-trips-table' style="margin: 0">
          <tbody>
            @foreach ($curTrips as $key => $trip)
            <?php
              $user = \App\User::where('id', $trip->user_id)->first();
              $traveler = \App\Traveler::where('id', $trip->traveler_id)->first();
            ?>
            @if ($key % 2 == 0)
            <tr class="row-even">
            @else
            <tr class="row-odd">
            @endif
              <td  width="25%" class="dot-dot-dot">{{ $traveler->name }}</td>
              <td  width="20%" class="dot-dot-dot">{{ $traveler->emerg_name }}</td>
              <td  width="20%">{{ $traveler->emerg_phone}}</td>
              <td  width="17%">${{ $trip->total - $trip->paid }}</td>
              <td width="18%"></td>
            </tr>
            <tr>
              <td colspan="5" class="coordinator-trips-expanded relative">
                <div class="expander coordinator-expander">
                  <a href="javascript:;" class="expander-controller absolute">Show details</a>
                  <div class="expander-header"></div>
                  <div class="expander-content">
                    <div class="flex-row-start" style="padding: 10px">
                      <div style="width: 15%;">
                        <p>USER NAME:</p>
                        <p>HOME PHONE:</p>
                        <p>CELL PHONE:</p>
                        <p>RELATIONSHIP:</p>
                      </div>
                      <div style="width: 50%">
                        <p><strong>{{ $user->name }}</strong> </p>
                        <p><strong>{{ (strlen($user->home) > 0) ? $user->home : 'n/a' }}</strong> </p>
                        <p><strong>{{ (strlen($user->cell) > 0) ? $user->cell : 'n/a'  }}</strong> </p>
                        <p><strong>{{ $traveler->relationship }}</strong> </p>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
            @if (count($curTrips) < 7)
              @for ($i = count($curTrips); $i < 7; $i++)
                @if ($i % 2 == 0)
                <tr class="row-even">
                @else
                <tr class="row-odd">
                @endif
                  <td colspan="5" style="color: rgba(0,0,0,0)">null</td>
                </tr>
              @endfor
            @endif
          </tbody>
        </table>
        @if (count($curTrips) == 0)
        <div class="text-center default-container col-xs-8 col-xs-offset-2 z-depth-custom absolute" style="top: 50px;padding: 20px 30px 10px;background: white">
          <p>We haven't had any signups for this group yet! Once we do you'll be able to see the travelers details and balances here.
           </p>
         </div>
         @endif
      </div>
    </div>
  </div>
</div>

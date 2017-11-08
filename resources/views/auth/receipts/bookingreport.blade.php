  <div >
        <table cellpadding="0" cellspacing="0">
            <tr >
                <td colspan="2">
                    <table >
                        <tr>
                            <td class="title">
                                <img src="/assets/images/graphics/dragaud_logo_simple.png" style="height:50px; width: 166px;">
                            </td>

                            <td style="text-align:right; color: #333; font-size: 10px">
                              Dragaud Custom Sojourns<br>
                              Austin, Texas<br>
                               1 (800) 554 7437
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
              <td style="height: 30px"></td>
            </tr>

            <tr >
                <td colspan="2">
                    <table>
                        <tr>
                            <td style="color: #333">
                            	<strong>Administrator:</strong>
                                {{ title_case($admin->name) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
              <td style="height: 20px"></td>
            </tr>

            <table cellpadding="6" cellspacing="0">
              <tr>
                  <td style="background-color: #eee; border-bottom:1px solid #ddd;color: #333">
                      <strong>Group #{{ $group->number }}</strong>
                  </td>

                  <td style="background-color: #eee; border-bottom:1px solid #ddd;text-align: right;color: #333">
                      <strong>Details</strong>
                  </td>
              </tr>

              <tr>
                  <td style="border-bottom: 1px solid #eee;color: #333">
                      Destination
                  </td>

                  <td style="text-align:right;  border-bottom: 1px solid #eee;color: #333">
                      {{ $group->destination }}
                  </td>
              </tr>

              <tr class="item">
                  <td style="border-bottom: 1px solid #eee;color: #333">
                      Travel Dates
                  </td>

                  <td style="text-align:right;  border-bottom: 1px solid #eee;color: #333">
                      {{ $group->depart }} - {{ $group->return }}
                  </td>
              </tr>
              <tr class="item last">
                  <td style="color: #333">
                      School
                  </td>

                  <td style="text-align:right;color: #333">
                      {{ $group->school }}
                  </td>
              </tr>
              <tr class="spacer"><td></td></tr>

              <tr class="heading">
                  <td width="180"  style="background-color: #eee; border-bottom:1px solid #ddd;color: #333">
                      <strong>Traveler</strong>
                  </td>

                  <td width="180" style="background-color: #eee; border-bottom:1px solid #ddd;color: #333">
                      <strong>User</strong>
                  </td>

                  <td width="180" style="background-color: #eee; border-bottom:1px solid #ddd;color: #333">
                      <strong>Emergency</strong>
                  </td>

              </tr>
              @foreach ($trips as $trip)
              <?php
                $traveler = App\Traveler::where('id', $trip->traveler_id)->first();
                $user = App\User::where('id', $trip->user_id)->first();
               ?>
              <tr class="details">
                <td width="180" style="color: #333;border-bottom: 1px solid #ddd;">
                  <span style="font-weight: bold; font-size: 10px">{{ $traveler->name }}</span><br/>
                  <span style="font-size: 10px;">&nbsp; DOB: {{ $traveler->dob }}</span><br/>
                  <span style="font-size: 10px;">&nbsp; Gender: {{ $traveler->gender }}</span><br/>
                  <span style="font-size: 10px;">&nbsp; Package: {{ $trip->package }}</span>
                </td>
                <td width="180" style="color: #333;border-bottom: 1px solid #ddd;">
                  <span style="font-weight: bold; font-size: 10px">{{ $user->name }}</span><br/>
                  <span style="font-size: 10px;">&nbsp; Relationship: {{ $traveler->relationship }}</span><br/>
                  <span style="font-size: 10px">&nbsp; Cell: {{ $user->cell }}</span><br/>
                  <span style="font-size: 10px;">&nbsp; Home: {{ $user->home }}</span>
                </td>
                <td width="180" style="color: #333;border-bottom: 1px solid #ddd;">
                  <span style="font-weight: bold; font-size: 10px">{{ $traveler->emerg_name }}</span><br/>
                  <span style="font-size: 10px">&nbsp; Phone: {{ $traveler->emerg_phone }}</span>
                </td>
                <span style="font-size: 10px"></span>
              </tr>
              @endforeach
            </table>
        </table>
    </div>

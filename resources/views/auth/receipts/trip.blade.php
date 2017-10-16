  <div >
        <table cellpadding="0" cellspacing="0">
            <tr >
                <td colspan="2">
                    <table >
                        <tr>
                            <td class="title">
                                <img src="/assets/images/graphics/dragaud_logo_simple.png" style="height:50px; width: 166px;">
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
                            <strong>To:</strong><br>
                              {{ title_case($user->name) }}<br>
                              {{ title_case($user->street) }}, {{ $user->zip }}<br>
                              {{ $user->email }}<br>
                          </td>
                           <td style="text-align: right;color: #333">
                            <strong>From:</strong><br>
                              Dragaud Custom Sojourns<br>
                              Austin, Texas<br>
                               1 (800) 554 7437
                          </td>
                      </tr>
                      <tr>
                          <td style="color: #333;">
                            <strong>Traveler:</strong>
                              {{ title_case($traveler->name) }}
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
                      Travel Package
                  </td>

                  <td style="text-align:right;  border-bottom: 1px solid #eee;color: #333">
                      {{ title_case($trip->package) }}
                  </td>
              </tr>
              <tr class="item last">
                  <td style="color: #333">
                      Package Cost
                  </td>

                  <td style="text-align:right;color: #333">
                      ${{ $trip->total }}
                  </td>
              </tr>
              <tr class="spacer"><td></td></tr>
              <table cellpadding="6" cellspacing="0">
                <tr class="heading">
                    <td width="80"  style="background-color: #eee; border-bottom:1px solid #ddd;color: #333">
                        <strong>Date</strong>
                    </td>

                    <td width="100" style="background-color: #eee; border-bottom:1px solid #ddd;color: #333">
                        <strong>Method</strong>
                    </td>

                    <td width="170" style="background-color: #eee; border-bottom:1px solid #ddd;color: #333">
                        <strong>Reciept#</strong>
                    </td>

                    <td width="100" style="background-color: #eee;  text-align: left; border-bottom:1px solid #ddd;color: #333">
                        <strong>Amount</strong>
                    </td>

                    <td width="80" style="background-color: #eee;  text-align:left; border-bottom:1px solid #ddd;color: #333">
                        <strong>Balance</strong>
                    </td>
                </tr>
                @foreach ($payments as $payment)
                <tr class="details">
                    <td width="80" style="border-bottom: 1px solid #eee;color: #333">
                        {{ \Carbon\Carbon::parse($payment->created_at)->format('m/d/y') }}
                    </td>

                    <td width="100" style="border-bottom: 1px solid #eee;color: #333">
                        {{ title_case($payment->method) }}
                    </td>

                    <td width="170" style="border-bottom: 1px solid #eee;color: #333">
                        {{ $payment->verification }}
                        <a href="{{ URL::to('/') }}/payments/receipts/{{ $payment->verification }}" target="_blank" style="color: #2ea1c5; text-decoration: none"><img width="7px" src="/assets/images/icons/external-link.png"/></a>
                    </td>

                    <td width="100" style="border-bottom: 1px solid #eee; text-align: left; color: #333;">
                        ${{ $payment->amount }}
                    </td>
                    <td width="80" style="border-bottom: 1px solid #eee; text-align: left; color: #333;">
                        ${{ $payment->balance }}
                    </td>
                </tr>
                @endforeach
                <table cellpadding="6" cellspacing="15">
                  <tr class="total">
                  	<td ></td>
                  	<td style="text-align: right; color: #333; border-bottom: 1px solid #eee; ">Total paid: &nbsp; &nbsp; &nbsp; &nbsp; <strong>${{ $trip->total }}</strong><br></td>
                  </tr>
                </table>
              </table>
            </table>
        </table>
    </div>

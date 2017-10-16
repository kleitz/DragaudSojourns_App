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
                                Receipt: #{{ $payment->verification }}<br>
                                Paid: {{ \Carbon\Carbon::parse($payment->created_at)->format('F d, Y') }}
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
                            <td style="color: #333">
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

              <tr class="heading">
                  <td style="background-color: #eee; border-bottom:1px solid #ddd;color: #333">
                      <strong>Payment Method</strong>
                  </td>

                  <td style="background-color: #eee; border-bottom:1px solid #ddd;text-align: right;color: #333">
                      <strong>Amount</strong>
                  </td>
              </tr>

              <tr class="details">
                  <td style="color: #333">
                  </td>

                  <td style="text-align: right; color: #333">
                    <span style="font-size: 10px">( Prior balance: &nbsp; &nbsp; &nbsp; &nbsp; ${{ $payment->balance + $payment->amount }} </span>)
                  </td>
              </tr>

              <tr class="details">
                  <td style="color: #333">
                      {{ title_case($payment->method) }}
                  </td>

                  <td style="text-align:right; color: #333;border-bottom: 1px solid #ddd;height: 30px;">
                      - ${{ $payment->amount }}
                  </td>
              </tr>
              <tr class="total">
              	<td></td>
              	<td style="text-align: right; color: #333">Remaining balance: &nbsp; &nbsp; &nbsp; &nbsp; <strong>${{ $payment->balance }}</strong><br></td>
              </tr>
            </table>
        </table>
    </div>

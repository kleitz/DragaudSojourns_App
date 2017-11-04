<div class="panel panel-secure border-panel-light" style="margin: 0; border-radius: 5px 5px 0;">
  <div class="panel-heading flex-row-between">
    <h5 style="margin: 7px 0; font-weight: 300">Payments</h5>
    <div class="row fp-date" style="width: 70%; margin: 0">
      <div class="col-xs-1" style="padding: 0">
      </div>
      <div class="form-group col-xs-5" style="padding: 0; margin: 0">
        <input type="text" name="depart" class="form-control" id="payment-begin" >
      </div>
      <div class="col-xs-1" style="padding: 0">
        <p class="text-center" style="margin: 10px 0 0">to</p>
      </div>
      <div class="form-group col-xs-5" style="padding: 0; margin: 0">
        <input type="text" name="return" class="form-control" id="payment-end" >
      </div>
    </div>
  </div>
  <div class="panel-table-header">
    <table>
      <thead>
        <tr>
          <td width="30%">Traveler</td>
          <td width="20%">Receipt</td>
          <td width="16%">Date</td>
          <td width="18%">Amount</td>
          <td width="16%">Fee</td>
        </tr>
      </thead>
    </table>
  </div>
  <div class="panel-table-content clearfix">
    <table>
      <tbody>
        <tr v-for="payment in paymentsOut">
          <td class="show-account-user flex-row-start" style="width: 100%">
            <a :href="'/admin/' + admin +  '/accounts/1?search=' + payment.traveler.name" class="dot-dot-dot" style="max-width: 162px">@{{ payment.traveler.name }}</a>
            <div class="relative admin-helper-modal hidden">
              <div class="admin-helper fix-helper">
                <small>Details</small>
                <p>Birth date: <strong>@{{ payment.traveler.dob }}</strong> </p>
                <p>Gender: <strong>@{{ payment.traveler.gender }}</strong> </p>
                <p v-if="payment.traveler.relationship == 'Myself'" >Account owner</p>
                <p v-if="payment.traveler.relationship != 'Myself'">@{{ payment.traveler.relationship }}: <strong> @{{ payment.user.name }}</strong> </p>
                <small>Emergency</small>
                <p>Name: <strong>@{{ payment.traveler.emerg_name }}</strong> </p>
                <p>Phone: <strong>@{{ payment.traveler.emerg_phone }}</strong> </p>
              </div>
            </div>
          </td>
          <td width="20%">
            <a :href="'/payments/receipts/' + payment.verification " target="_blank" style="font-size: 20px; font-weight: 300">@{{ payment.verification }}</a>
          </td>
          <td width="16%">@{{ payment.date }}</td>
          <td width="18%">$@{{ payment.amount }}</td>
          <td width="16%">$@{{ payment.fee }}</td>
        </tr>
        <tr>
          <td width="30%" style="color: transparent; font-size: 20px">null</td>
          <td width="20%" style="color: transparent; font-size: 20px">null</td>
          <td width="16%" style="color: transparent; font-size: 20px">null</td>
          <td width="18%" style="color: transparent; font-size: 20px">null</td>
          <td width="16%" style="color: transparent; font-size: 20px">null</td>
        </tr>
        <tr v-if="minRange > 0" v-for="n in minRange">
          <td width="30%" style="color: transparent; font-size: 20px">null</td>
          <td width="20%" style="color: transparent; font-size: 20px">null</td>
          <td width="16%" style="color: transparent; font-size: 20px">null</td>
          <td width="18%" style="color: transparent; font-size: 20px">null</td>
          <td width="16%" style="color: transparent; font-size: 20px">null</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class='fpayments-total-container flex-row-start'>
  <div class="flex-col-center" style="width: 65%; padding: 0 15px 0;">
    <p class="text-right" style="width: 100%;  margin: 0">Totals: </p>
  </div>
  <div class="fpayments-total flex-col-center" style="width: 18%; margin: 0 -2px 0">
    <p style="margin: 0">$@{{ paymentsTotal }}</p>
  </div>
  <div class="fpayments-total flex-col-center" style="width: 15.6%; border-radius: 0">
    <p style="margin: 0">$@{{ feesTotal }}</p>
  </div>
  <div class="fpayments-spacer"></div>
</div>

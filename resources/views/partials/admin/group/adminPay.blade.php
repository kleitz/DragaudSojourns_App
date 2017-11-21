<div class="abs-fill hidden" id="payment-modal" style="z-index: 500">
  <div class="flex-abs-center full-height">
  <!-- PAYMENT DETAILS -->
  <div  class="panel panel-secure full-width payment-modal absolute" style="max-width: 400px">
    <div class="panel-heading flex-row-between">
      <h2 class="panel-title flex-col-center">Adjust balance</h2>
      <span class="modal-ds-close pointer" @click="closePayment">X</span>
    </div>
    <div class="panel-body grey-panel">

      <!-- PAYMENT AMOUNT INPUT -->
      <div class="panel panel-secure-inner border-panel-light">
        <h5 style="margin-bottom: 20px;font-weight: 300;font-size:24px">Traveler: @{{ payment.traveler.name }}</h5>
        <div class="payment-input">
          <label for="amount">@{{ method }} amount</label>
          <div class="input-group payment-input-label">
            <div class="input-group-addon">$</div>
            <input @keyup="updatePayment" v-model="payment.amount" type="text" class="form-control floats-only currency-format">
          </div>
          <div style="margin-top: 15px">
            <label for="remainigbalance">Remaining balance</label>
            <h5>$@{{ remainingBalance }}</h5>
          </div>
        </div>
      </div>
      <!-- PAYMENT TYPE SELECT -->
      <div class="payment-type">
        <label class="custom-control custom-radio">
          <input checked="false" id="radio-discount" name="radio" type="radio" class="custom-control-input" @click="selectDiscount">
          <span class="custom-control-indicator"></span>
          <span class="custom-control-description" style="font-size: 18px; font-weight: 300">Discount</span>
        </label>
        <label class="custom-control custom-radio" style="margin-left: 10px">
          <input checked="true" id="radio-payment" name="radio" type="radio" class="custom-control-input" @click="selectPayment">
          <span class="custom-control-indicator"></span>
          <span class="custom-control-description" style="font-size: 18px; font-weight: 300">Payment</span>
        </label>
      </div>
      <!-- PAYPAL CONTINUE -->
      <div class="panel panel-secure-inner border-panel-light modal-popup-form">
        <div class="form-group">
          <label for="method">Method</label>
          <input v-model="payment.method" type="text" class="form-control" name="method" @keyup="checkPayment">
        </div>
        <div class="form-group" style="margin-bottom: 30px">
          <label for="method">Payment date</label>
          <input type="text" name="depart" class="form-control" id="payment-date" v-model="today">
        </div>
        <button @click="processPayment" type="button" style="height: 50px" v-bind:class="{'button-locked' : paymentValid == false, 'ds-button full-width button-gen waves-effect waves-light' : true}">
          <img v-if="paymentValid == false" src="/assets/images/icons/locked-padlock.png" />Apply $@{{ payment.amount }}</button>
      </div>
    </div>
  </div>

</div>
</div>

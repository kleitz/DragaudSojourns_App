<template id="payment-modal-template">
  <div class="full-height">
    <!-- PAYMENT DETAILS -->
    <div id="payment-modal" class="panel panel-secure full-width payment-modal absolute" style="z-index: 2; overflow: visible;">
      <div class="panel-heading flex-row-between">
        <h2 class="panel-title flex-col-center">New payment</h2>
        <span class="modal-ds-close pointer" @click="closeMe">X</span>
      </div>
      <div class="panel-body grey-panel">

        <!-- PAYMENT TYPE SELECT -->
        <div class="payment-type">
          <label class="custom-control custom-radio">
            <input checked="false" id="radio-paypal" name="radio" type="radio" class="custom-control-input" @click="selectPaypal">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description"><img src="/assets/images/icons/paypal.png" height="20px"/></span>
          </label>
          <label class="custom-control custom-radio" style="margin-left: 10px">
            <input checked="true" id="radio-credit" name="radio" type="radio" class="custom-control-input" @click="selectCredit">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description"><img class="clear-img" src="/assets/images/icons/credit_option.png" height="32px"/></span>
          </label>
        </div>
        <!-- PAYMENT AMOUNT INPUT -->
        <div class="panel panel-secure-inner border-panel-light">
          <h5>{{ tripDetails.traveler }}'s trip to {{ tripDetails.destination }}</h5>
          <div class="payment-input">
            <label for="amount">Payment amount</label>
            <div class="input-group payment-input-label">
              <div class="input-group-addon">$</div>
              <input id="payment-amount" v-model="paymentDetails.amount" @keyup="updatePayment" type="text" class="form-control floats-only currency-format" value="0.00">
            </div>
            <div style="margin-top: 15px">
              <label for="remainigbalance">Remaining balance</label>
              <h5>${{ remainingBalance }}</h5>
            </div>
          </div>
        </div>
        <!-- PAYPAL CONTINUE -->
        <div id="paypal-option" class="panel panel-secure-inner border-panel-light hidden">
          <div v-if="processingErr == true" id="payment-details-err">
            <div class="ds-form-error ds-details-err flex-row-start" style="padding: 8px 20px !important; border-radius: 3px 3px 0 0 !important">
              <img src="/assets/images/icons/hazard_tri.png" class="input-hazard"/>There was an error processing your payment.<br/>
              Please select another payment method or try again.
            </div>
          </div>
          <p>Continue to Paypal and login</p>
          <button @click="processPayment" type="button" v-bind:class="{'button-locked' : paymentValid == false, 'ds-button full-width button-gen waves-effect waves-light' : true}">
            <img v-if="paymentValid == false" src="/assets/images/icons/locked-padlock.png" />Pay ${{ formatButton }}</button>
        </div>
        <!-- CREDIT CARD CONTINUE-->
        <div id="credit-option" class="panel panel-secure-inner border-panel-light">
          <div v-if="processingErr == true" id="payment-details-err">
            <div class="ds-form-error ds-details-err flex-row-start" style="padding: 8px 20px !important; border-radius: 3px 3px 0 0 !important">
              <img src="/assets/images/icons/hazard_tri.png" class="input-hazard"/>There was an error processing your payment.<br/>
              Please select another payment method or try again.
            </div>
          </div>
          <form class="payment-input">
            <div class="form-group">
              <label for="cardholder">Name on card</label>
              <input @keyup="updatePayment"  v-model="paymentDetails.cardholder" type="text" class="form-control credit-input" name="cardholder">
            </div>
            <div class="form-group">
              <label for="cardnumber">Card number</label>
              <input @keyup="updatePayment" maxlength="19" v-model="paymentDetails.cardnumber" type="text" class="form-control credit-input numbers-only credit-format" name="cardnumber">
            </div>
            <div class="flex-row-between">
              <div class="form-group" style="margin-bottom: 22px; width: 120px">
                <label for="expiry">Expiry date</label>
                <div class="flex-row-start">
                  <select @change="updatePayment" v-model="paymentDetails.exp_m" class="custom-select form-control" name="expiry" style="margin-right: 5px">
                    <option selected class="select-default">MM</option>
                    <option v-for="month in selectMonth" :value="month" > {{ month }} </option>
                  </select>
                  <select @change="updatePayment" v-model="paymentDetails.exp_y" class="custom-select form-control" name="expiry">
                    <option selected class='select-default'>YY</option>
                    <option v-for="year in selectYear" :value="year" > {{ year }} </option>
                  </select>
                </div>
              </div>
              <div class="form-group" style="margin-bottom: 22px; width: 120px">
                <label for="cvv2">Security code</label>
                <div class="input-group">
                  <input @keyup="updatePayment" v-model="paymentDetails.cvv2" maxlength="4" type="text" class="form-control credit-input numbers-only" name="cvv2">
                  <div @click="showHelper" class="input-group-addon pointer">?</div>
                </div>
                <div id="cvv2-helper" class="helper-modal hidden" style="margin-top: 10px; width: 230px">
                  <p>Visa, Mastercard, Discover<br/>The 3 digits on the <i>back</i> of your card</p>
                </div>
              </div>
            </div>
          </form>
          <button @click="processPayment" type="button" v-bind:class="{'button-locked' : paymentValid == false, 'ds-button full-width button-gen waves-effect waves-light' : true}">
            <img v-if="paymentValid == false" src="/assets/images/icons/locked-padlock.png" />Pay ${{ formatButton }}</button>
        </div>
      </div>
    </div>
    <div class="abs-fill flex-col-center" style="z-index: 1">
      <!-- SAVING PAYMENT -->
      <loading-modal :id="'payment-loader'">
        <template slot="header">Please wait...</template>
        <template slot="message">We're saving your payment in our system</template>
      </loading-modal>
      <!-- PAYMENT SUCCESSFUL -->
      <success-modal :id="'payment-success'" :button="'View receipt'" :sub="true" :subxs="true">
        <template slot="header">${{ paymentDetails.amount }}</template>
        <template slot="message">Your payment is complete.</template>
        <template slot="subscript">Verification code:</template>
        <template slot="subscript-xs">{{ receiptCode }}</template>
      </success-modal>
    </div>
  </div>
</template>

<script>
import LoadingModal from './LoadingModal.vue';
import SuccessModal from './SuccessModal.vue';

  export default {
    template: "#payment-modal-template",
  	props : [],
  	data() {
  		return {
        tripDetails: true,
        paymentValid: false,
        processingErr: false,
        selectMonth: ['01','02','03','04','05','06','07','08','09','10','11','12'],
        selectYear: [],
        paymentMethod: 'credit',
        receiptCode: '',
        paymentDetails: { amount: '0.00', cardholder: '', cardnumber: '', exp_m: '', exp_y: '', cvv2: '', method: '' },
        paymentSave: { amount: '0.00', fee: '0.00', balance: '', paypal_id: '', user_id: authUsr.id, trip_id: '', group_id: '', method: 'credit'}
  		}
  	},
    methods: {
      closeMe(){
        fadeOut('#dark-overlay');
        zoomOut('#new-payment-modal');
        this.$emit('close');
      },
      updatePayment(){
        let amt = $('#payment-amount').val();
        this.getMethod();
        this.hideHelper();
        if (parseFloat(amt) > parseFloat(this.tripDetails.trip_balance))
          amt = this.tripDetails.trip_balance;
        this.paymentDetails.amount = amt;

        this.paymentValid = false;
        if (this.paymentMethod == 'paypal'){
          if (this.paymentDetails.amount > 0)
            this.paymentValid = true;
        } else {
          let cardNum = this.paymentDetails.cardnumber;
          let cardStr = cardNum.toString().replace(/-/g, '');
          if (this.paymentDetails.amount > 0 && this.paymentDetails.cardholder != '' &&
              this.paymentDetails.exp_y != 'YY' && this.paymentDetails.exp_m != 'MM' &&
              this.paymentDetails.cvv2.toString().length > 2 && cardStr.length > 11)
            this.paymentValid = true;
        }
      },
      getMethod(){
        let cardNum = this.paymentDetails.cardnumber.toString().replace(/-/g, '');
        var type = creditCardType(cardNum);
        if (type[0].type){
          this.paymentDetails.method = type[0].type;
          $("#cvv2-helper").html(
            "<p>Visa, Mastercard, Discover:<br/>The 3 digits on the <i>back</i> of your card</p>"
          );
          if (type[0].type != 'visa' && type[0].type != 'discover' &&  type[0].type != 'master-card')
            $("#cvv2-helper").html(
              "<p>American Express:<br/>The 4 digits on the <i>front</i> of your card</p>"
            );
        } else {
          this.paymentDetails.method = 'visa';
        }
      },
      selectPaypal(event){
        this.paymentMethod = 'paypal';
        $(event.target).prop("checked", true);
        $("#radio-credit").prop("checked", false);
        $("#credit-option").addClass('hidden');
        $("#paypal-option").removeClass('hidden');
        this.updatePayment();
        this.calculateFee();
      },
      selectCredit(event){
        this.paymentMethod = 'credit';
        $(event.target).prop("checked", true);
        $("#radio-paypal").prop("checked", false);
        $("#credit-option").removeClass('hidden');
        $("#paypal-option").addClass('hidden');
        this.updatePayment();
        this.calculateFee();
      },
      calculateFee(){
        let $amount = parseFloat(this.paymentDetails.amount);
        if (this.paymentMethod == 'credit') {
          this.paymentSave.fee = ($amount < 100) ? formatCurrency($amount * .2) : '20.00';
        } else  {
          this.paymentSave.fee = '0.00';
        }
      },
      showHelper(){
        slideLeft("#cvv2-helper");
      },
      hideHelper(){
        fadeOut("#cvv2-helper");
      },
      processPayment(){
        this.updatePayment();
        zoomOut('#payment-modal');
        slideLeft('#payment-loader');
        let valid = true;
        if (this.paymentMethod == 'paypal'){
          valid = this.processPaypal();
        } else if (this.paymentMethod == 'credit') {
          valid = this.processCredit();
        }
      },
      processPaypal(){
        this.savePayment();
      },
      processCredit(){
        this.savePayment();
      },
      savePayment(){
        this.paymentSave.paypal_id = Date.now();
        this.paymentSave.method = this.paymentMethod;
        this.paymentSave.amount = this.paymentDetails.amount;
        let payApp = this;
        $.ajax({
            type: "POST",
            url: '/payments/store',
            data: { payment : payApp.paymentSave},
            success: function(data){
              let response = JSON.parse(data);
              if (response.status == "SUCCESS") {
                payApp.processingErr = false;
                payApp.receiptCode = response.verification;
                $("#payment-success-button").attr("href", "/payments/receipts/" + response.verification);
                setTimeout(function(){
                  zoomOut('#payment-loader');
                  slideLeft('#payment-success');
                },2000);
              } else {
                setTimeout(function(){
                  payApp.processingErr = true;
                  zoomOut('#payment-loader');
                  slideLeft('#payment-modal');
                },2000);
              }
            }
        });
      }
    },
    mounted() {
      this.tripDetails = tripPayment;
      this.paymentSave.trip_id = this.tripDetails.trip_id;
      this.paymentSave.group_id = this.tripDetails.group_id;
      let curYear = (new Date).getFullYear();
      for (let i = 0; i <= 10; i++){
        this.selectYear[i] = (curYear + i).toString().slice(-2);
      }
      $("#payment-success-close").attr("href", window.location.href);
      $("#payment-success-button").attr("target", '_blank');
      bindFormatters();
    },
    computed: {
      remainingBalance(){
        let val = this.tripDetails.trip_balance - this.paymentDetails.amount;
        if (parseFloat(val) < 0)
          val = 0;
        this.paymentSave.balance = formatCurrency(val);
        return formatCurrency(val);
      },
      formatButton(){
        this.calculateFee();
        return formatCurrency(this.paymentDetails.amount).toString();
      },
    },
    components: {
      SuccessModal,
      LoadingModal
    }
  }
</script>

<style>

</style>

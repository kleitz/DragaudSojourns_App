<template id="new-booking-modal-template">
  <div>
    <div id="new-booking-details" class="rounded-wrapper flex-col-center overlay-near-shadow full-width">
      <div class="flex-row-reverse">
        <a class="modal-ds-close rounded-close pointer" @click="closeMe" >X</a>
      </div>
      <div class="rounded-content">
        <h3 class="rounded-title text-center">Booking a new trip with us?</h3>
        <h4 class="rounded-subtitle text-center">That’s great! Please enter your booking number and select the traveler that will join us</h4>
        <form >
          <div class="form-group row" >
            <div class="col-sm-2 flex-col-end" style="min-height: 50px">
              <div class="new-booking-icon flex-row-center">
                <img src="/assets/images/icons/suitcase.png">
              </div>
            </div>
            <div class="col-sm-10 material-input-group">
              <label for="bookingnumber" class="material-label">Booking Number</label>
              <input @keyup="findGroup" @change="findGroup" v-model="newTrip.group_name" type="text" class="form-control numbers-only material-input" name="bookingnumber" id="booking-number">
            </div>
          </div>
          <div class="form-group row" >
            <div class="col-sm-2 flex-col-end" style="min-height: 50px">
              <div class="new-booking-icon flex-row-center">
                <img src="/assets/images/icons/person.png">
              </div>
            </div>
            <div class="col-sm-10 material-input-group">
              <label for="bookingtraveler" class="material-label">Traveler</label>
              <select @change="detailsProceed" v-model="newTrip.traveler" class="custom-select form-control material-input" name="bookingtraveler" id="booking-traveler">
                <option selected> </option>
                <option v-for="traveler in userTravelers" :value="traveler.id" > {{ traveler.name }} </option>
              </select>
              <span id="booking-traveler-err" class="text-left ds-form-errmsg">This traveler is already booked in group {{ groupDetails.number }}</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-2 flex-col-end" style="min-height: 50px">
              <div class="new-booking-icon flex-row-center">
                <img src="/assets/images/icons/bed.png">
              </div>
            </div>
            <div class="col-sm-10 material-input-group">
              <label for="bookingpackage" class="material-label">Package</label>
              <select v-model="newTrip.total" @change="detailsProceed" class="custom-select form-control material-input" name="bookingpackage" id="booking-package">
                <option selected> </option>
                <option v-for="packages in groupDetails.packages" :value="packages.cost" > {{ packages.name }}: ${{ packages.cost }}</option>
              </select>
            </div>
          </div>
          <div class="new-booking-display">
            <div v-if="groupExists == false" class="new-booking-default full-width full-height flex-col-center">
              <img src="/assets/images/icons/plane.png"/>
              <p>Your group's travel details will appear here</p>
            </div>
            <div v-if="groupExists == true" class="new-booking-filled">
              <div class="booking-filled-header flex-row-between">
                <h4 class="full-width dot-dot-dot" style="padding-right: 5px">{{ groupDetails.number + ": " + groupDetails.destination }}</h4>
                <h4 class="booking-filled-amount">{{ (newTrip.total > 0) ? "$" + Math.round(newTrip.total) : "-"}}</h4>
              </div>
              <div class="booking-filled-details flex-row-between row">
                <div class="col-xs-4" style="padding-right: 0;">
                  <div class="booking-icon-img full-width">
                    <div class="group-icon-img" :style="{ background: 'url(/' + groupDetails.icon + ')' }"></div>
                  </div>
                </div>
                <div class="col-xs-8 flex-col-start">
                  <h5 class="full-width dot-dot-dot">{{ groupDetails.school }}</h5>
                  <div class="row">
                    <div class="col-xs-4">
                      <p>Departs</p>
                    </div>
                    <div class="col-xs-8">
                      <p><strong>{{groupDetails.depart}}</strong></p>
                    </div>
                  </div>
                  <div class="row booking-filled-controw">
                    <div class="col-xs-4">
                      <p>Returns</p>
                    </div>
                    <div class="col-xs-8">
                      <p><strong>{{groupDetails.return}}</strong></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-if="groupExists == true">
            <label class="custom-control custom-checkbox">
              <div class="flex-row-between">
                <input @change="detailsProceed" id="release-agree" type="checkbox" class="custom-control-input booking-checkbox">
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description booking-checkbox-description">I have read and agree to the terms of Dragaud Custom Sojourn’s
                  <a :href="'/' + groupDetails.release" target="_blank" style="font-size: 14px; font-weight: 400">Release of Liability and Cancellation Policy</a>
                </span>
              </div>
            </label>
          </div>
          <button id="booking-details-button" @click="showInsurance" type="button" name="submitdetails" disabled="disabled" v-bind:class="{'button-locked' : tripDetails == false, 'ds-button button-gen waves-effect waves-dark full-width' : true}" style="margin-top: 15px;">
      			<img v-if="tripDetails == false" src="/assets/images/icons/locked-padlock.png" />Book now!
      		</button>
        </form>
      </div>
    </div>

    <div id="new-booking-insurance" class="rounded-wrapper flex-col-center overlay-near-shadow full-width hidden">
      <div class="flex-row-reverse">
        <a class="modal-ds-close rounded-close pointer" @click="closeMe" >X</a>
      </div>
      <div class="rounded-content">
        <h3 class="rounded-title text-center">Do you want traveler’s insurance?</h3>
        <h4 class="rounded-subtitle text-center">Berkshire Hathaway travel protection is available for all custom packages. Select the option below and we'll get in touch.
        </h4>
        <div class="new-booking-display" style="margin-top: 0px">
          <div style="padding: 20px">
            <label class="custom-control custom-checkbox">
              <div class="flex-row-between">
                <input @change="insuranceConfirm" id="insurance-agree" type="checkbox" class="custom-control-input booking-checkbox">
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description booking-checkbox-description">I am interested in receiving information about travel insurance through Berkshire Hathaway.
                </span>
              </div>
            </label>
          </div>
        </div>
        <div class="flex-row-center">
          <a href="javascript:;" id="pwreset-confirm" class="overlay-wide-button ds-button button-cancel" @click="backToDetails">Previous</a>
          <a href="javascript:;" id="pwreset-cancel" class="overlay-wide-button ds-button button-gen" @click="showConfirmation">Continue</a>
        </div>
      </div>
    </div>

    <div id="new-booking-confirm" class="rounded-wrapper flex-col-center overlay-near-shadow full-width hidden">
      <div class="flex-row-reverse">
        <a class="modal-ds-close rounded-close pointer" @click="closeMe" >X</a>
      </div>
      <div class="rounded-content">
        <h3 class="rounded-title text-center">Confirm your selection</h3>
        <h4 class="rounded-subtitle text-center">{{ newTrip.trav_name }} will be traveling with us for our trip to {{ groupDetails.destination }} on {{ groupDetails.depart }}?
        </h4>
        <div class="flex-row-center">
          <a href="javascript:;" id="pwreset-confirm" class="overlay-wide-button ds-button button-cancel" @click="backToInsurance">Previous</a>
          <a href="javascript:;" id="pwreset-cancel" class="overlay-wide-button ds-button button-gen" @click="saveNewTrip">Confirm</a>
        </div>
      </div>
    </div>

    <div class="flex-abs-center abs-fill">
      <!-- Saving updates -->
      <loading-modal :id="'booking-loader'">
        <template slot="header">Please wait...</template>
        <template slot="message">We're booking your new trip</template>
      </loading-modal>
      <!-- Update successful-->
      <success-modal :id="'booking-success'" :button="'Continue'" :sub="false" :subxs="false">
        <template slot="header">Trip booked!</template>
        <template slot="message">You can review travel details and make a payment from your trips tab.</template>
      </success-modal>
    </div>
  </div>
</template>

<script>
import LoadingModal from './LoadingModal.vue';
import SuccessModal from './SuccessModal.vue';

  export default {
    template: "#new-booking-modal-template",
  	props : [],
  	data() {
  		return {
        tripDetails: false,
        groupExists: false,
        spotTaken: true,
        userTravelers: authTravs,
        groupInit: { id: "", number: "", destination: "", depart: "", return: "",
                        school: "", packages: "", icon: "", itinerary: "", release: "",
                        message: "" },
        groupDetails: "",
        newTrip: { group: "", group_name: "", user: authUsr.id, traveler: "", trav_name: "", insurance: "No", package: "", total: ""},
  		}
  	},
    methods: {
      closeMe(){
        this.$emit('close');
        fadeOut("#dark-overlay");
        zoomOut("#new-booking-modal");
      },
      findGroup(){
        let bookApp = this;
        $.ajax({
            type: "GET",
            url: '/groups/specific',
            data: { bookingNum : bookApp.newTrip.group_name},
            success: function(data){
              if (data != "") {
                bookApp.groupExists = true;
                bookApp.groupDetails = data;
                for (let i = 0; i < bookApp.groupDetails.packages.length; i++){
                  let str = toTitleCase(bookApp.groupDetails.packages[i].name);
                  bookApp.groupDetails.packages[i].name = str;
                }
              } else {
                bookApp.groupExists = false;
                bookApp.groupDetails = bookApp.groupInit;
              }
            }
        });
        this.detailsProceed();
      },
      detailsProceed(){
        let pName = $("#booking-package option:selected").text();
        this.newTrip.package = pName.slice(0, pName.indexOf(':'));
        this.newTrip.trav_name = $("#booking-traveler option:selected").text();
        this.tripPrecheck();
        if (this.groupExists == true && this.newTrip.group_name != "" &&
            this.newTrip.traveler != "" && this.newTrip.package != "" &&
            $("#release-agree").prop("checked") == true && this.spotTaken == false){
          this.tripDetails = true;
          $("#booking-details-button").prop('disabled', false);
          this.newTrip.group = this.groupDetails.id;
        } else {
          this.tripDetails = false;
          $("#booking-details-button").prop('disabled', true);
          this.newTrip.group = "";
        }
      },
      insuranceConfirm(){
        if ($("#insurance-agree").prop("checked") == true) {
          this.newTrip.insurance = 'Yes';
        } else {
          this.newTrip.insurance = 'No';
        }
      },
      saveNewTrip(){
        let bookApp = this;
        zoomOut("#new-booking-confirm");
        slideLeft("#booking-loader");
        $.ajax({
          type: "POST",
          url: '/trips/store',
          data: { trip: bookApp.newTrip},
          success: function(response){
            setTimeout(function(){
              zoomOut("#booking-loader");
              slideLeft("#booking-success");
            },2000);
          }
        });
      },
      tripPrecheck(){
        let bookApp = this;
        $.ajax({
            type: "GET",
            url: '/trips/precheck',
            data: { group: bookApp.groupDetails.id, traveler: bookApp.newTrip.traveler},
            success: function(data){
              if (data == "TAKEN") {
                validator.showError(['booking-traveler']);
                bookApp.spotTaken = true;
              } else {
                validator.hideError(['booking-traveler']);
                bookApp.spotTaken = false;
              }
            }
        });
      },
      showInsurance(){
        zoomOut("#new-booking-details");
        slideLeft("#new-booking-insurance");
      },
      backToDetails(){
        zoomOut("#new-booking-insurance");
        slideLeft("#new-booking-details");
      },
      showConfirmation(){
        zoomOut("#new-booking-insurance");
        slideLeft("#new-booking-confirm");
      },
      backToInsurance(){
        zoomOut("#new-booking-confirm");
        slideLeft("#new-booking-insurance");
      }
      // app-wise functions
    },
    mounted() {
      // do this when ready
      console.log(toTitleCase('muffin sparks'))
      bindFormatters();
      $("#booking-success-close, #booking-success-button").attr("href", '/profile/' + authUsr.email);
      $("#release-agree").prop("checked", false);
      this.groupDetails = this.groupInit;
    },
    computed: {
      // computed data
    },
    components: {
      SuccessModal,
      LoadingModal,
    }
  }
</script>

<style>

</style>

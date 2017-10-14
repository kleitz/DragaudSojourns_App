window.Vue = require('vue');

let profileElem = ['usr-email', 'usr-street', 'usr-zip', 'usr-home', 'usr-cell'];
let profileCx = document.getElementsByClassName('profile-success');

import TravelerModal from './components/TravelerModal.vue';
import ConfidentialModal from './components/ConfidentialModal.vue';
import NewBookingModal from './components/NewBookingModal.vue';
import NewPaymentModal from './components/NewPaymentModal.vue';

const bus = new Vue();

// Account view controller
const accountApp = new Vue({
    el: '#accountApp',
    data: {
      userExpand: false,
      userErr: {name: {v: false, e: 'usr-name', t: 'string'},
                street: {v: false, e: 'usr-street', t: 'string'},
                zip: {v: false, e: 'usr-zip', t: 'zip'},
                cell: {v: false, e: 'usr-cell', t: 'phone'},
                home: {v: false, e: 'usr-home', t: 'phone'}
              },
      userDetails: authUsr,
      userTravelers: authTravs
    },
    methods: {
      userDetailsExpand(){
        $("#usr-name").focus();
        for (let i = 0; i < profileCx.length; i++){
          $(profileCx[i]).addClass('opaque');
        }
        let link = $("#profile-expand");
        let el = this.userErr;
        let profileErr = [
              {elem: el.name.e, type: el.name.t},
              {elem: el.street.e, type: el.street.t},
              {elem: el.zip.e, type: el.zip.t}
            ];
        if (this.userDetails.home || (!this.userDetails.cell && !this.userDetails.home))
            profileErr.push({elem: el.home.e, type: el.home.t});
        if (this.userDetails.cell || (!this.userDetails.cell && !this.userDetails.home))
            profileErr.push({elem: el.cell.e, type: el.cell.t});
        let check = validator.isValid(profileErr);
        if (link.text() == 'Save changes') {
            this.updateUserData(check);
        } else {
            validator.hideError(profileElem);
            closeExpander($("#profile-details"));
            this.userExpand = true;
            link.text('Save changes');
        }
      },
      updateUserData(check){
        let acctApp = this;
        if (check == true) {
          $.ajax({
              type: "POST",
              url: '/profile/user/update',
              data: { user : acctApp.userDetails, id : authUsr.id },
              success: function(data){
                if (data == "SUCCESS") {
                  acctApp.userExpand = false;
                  for (let i = 0; i < profileCx.length; i++){
                    setTimeout(function(){
                      $(profileCx[i]).removeClass('opaque');
                    }, 200*i);
                  }
                  setTimeout(function(){
                    openExpander($("#profile-details"));
                    $("#profile-expand").text('Edit your profile');
                    window.location.replace('/profile/' + acctApp.userDetails.email);
                  }, 1200);
                }
              }
          })
        } else {
          for (let i = 0; i < check.length; i++){
            for (let prop in this.userErr){
              if(check[i] == this.userErr[prop].e)
                this.userErr[prop].v = true;
            }
          }
        }
      },
      userDetailsClear(){
        let acctApp = this;
        openExpander($("#profile-details"));
        validator.hideError(profileElem);
        this.userExpand = false;
        $("#profile-expand").text('Edit your profile');
        setTimeout(function(){
          window.location.replace('/profile/' + acctApp.userDetails.email);
        }, 400);
      },
      emptyTraveler(){
        let trav = this.userTravelers;
        if (trav.length == 0 || (trav[trav.length - 1].created_at != "")){
          trav.push({
            created_at: "", updated_at: "",
            name: "", gender: "", relationship: "",
            emerg_name: "", emerg_phone: "",
            id: "", user: this.userDetails.id
          })
        }
      },
      removeNewTraveler(){
        let trav = this.userTravelers;
        setTimeout(function(){
          trav.pop();
        }, 400);
      },
      alert(){
        alert('yay');
      },
      validate(el){
        if(el.v == true) {
          validator.hideError(profileElem);
          validator.isValid([{elem: el.e, type: el.t}]);
        }
      },
      showConfidentModal(){
        bus.$emit("CONFIDENTIAL");
        fadeIn('#dark-overlay');
        slideLeft('#confidential-modal');
      },
      showBookingModal(){
        bus.$emit("BOOKING");
        fadeIn('#dark-overlay');
        slideLeft('#new-booking-modal');
      },
      showPaymentModal(elem){
        tripPayment = elem;
        bus.$emit("PAYMENT");
        fadeIn('#dark-overlay');
        slideLeft('#new-payment-modal')
      }
    },
    mounted() {
      // do this when ready
    },
		components: {
			TravelerModal,
		},
    computed: {
      // computed data
    }
});

// Change email/password view controller

const overlayApp = new Vue({
    el: '#dark-overlay',
    data: {
      newPayment: false,
      newBooking: false,
      newConfidential: false,
    },
    methods: {
      // app-wise functions
      paymentClose(){
        this.newPayment = false;
      },
      bookingClose(){
        this.newBooking = false;
      },
      confidentialClose(){
        this.newConfidential = false;
      }
    },
    mounted() {
      // do this when ready
      bus.$on('PAYMENT', ()=> this.newPayment = true);
      bus.$on('BOOKING', ()=> this.newBooking = true);
      bus.$on('CONFIDENTIAL', ()=> this.newConfidential = true);
    },
    components: {
      ConfidentialModal,
      NewBookingModal,
      NewPaymentModal,
    },
    computed: {
      // computed data
    }
});

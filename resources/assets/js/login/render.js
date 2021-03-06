
window.Vue = require('vue');

import TravelerModal from './components/TravelerModal.vue';
import SuccessModal from './components/SuccessModal.vue';
import LoadingModal from './components/LoadingModal.vue';

const regApp = new Vue({
    el: '#msform',
    data: {
			submitAttempt: false,
			emailExists: false,
      regIncomplete: false,
      precheck: "",
			numTravelers: 1,
			reguser: {email: "", pass: "", passconf: "", name: "",
								cell: "", home: "", street: "", zip: ""},
			regtravelers: [{name: "", gender: "", relate: "", emerg: "", ephn: "", dob: ""}]
		},
		methods: {
			insertTraveler(){
				this.regtravelers.push({name: "", gender: "", relate: "", emerg: "", ephn: "", dob: ""});
				$('.traveler-modal-container').addClass('active');
				bindTravelerModal($('.traveler-modal-title'));
				this.submitAttempt = false;
				this.numTravelers++;
			},
			updateTravelers(newObj, pos) {
					this.regtravelers[pos] = newObj;
			},
			deleteTraveler(index){
				Vue.delete(this.regtravelers, index);
				this.numTravelers--;
        if (this.regIncomplete == true)
          this.testTravelers();
			},
      clearTravelers(){
        for (let i = 0; i < this.numTravelers; i++){
          let el='#traveler-modal'+ i;
          $(el).css('max-height', '29px');
        }
        let regApp = this;
        setTimeout(function(){
          regApp.numTravelers=0;
          regApp.regtravelers = [];
          regApp.regIncomplete = false
        }, 400);
      },
      testTravelers(){
        this.regIncomplete = false;
        for (let i = 0; i < this.numTravelers; i++){
          this.$refs.traveler[i].hasSubmit = true;
          this.$refs.traveler[i].testError({elem: 'reg-trav' + i + '-fullname', type: 'string'});
          this.$refs.traveler[i].testError({elem: 'reg-trav' + i + '-gender', type: 'select'});
          this.$refs.traveler[i].testError({elem: 'reg-trav' + i + '-relate', type: 'select'});
          this.$refs.traveler[i].testError({elem: 'reg-trav' + i + '-emerg', type: 'string'});
          this.$refs.traveler[i].testError({elem: 'reg-trav' + i + '-ephn', type: 'phone'});
          this.$refs.traveler[i].testError({elem: 'reg-trav' + i + '-dob', type: 'date'});
        }
      },
      formTwo() {
        if (this.verifyEmail() == false)
          regFormTwo();
      },
      formThree(){
        regFormThree();
      },
      canSubmit(){
          let errTotal = 0;
          for (let i = 0; i < this.numTravelers; i++){
            errTotal += this.$refs.traveler[i].warnings.length;
          }
          if (errTotal > 0) {
            this.regIncomplete = true;
          } else {
            this.regIncomplete = false;
          }
      },
			sendData() {
        this.submitAttempt = true;
        if (this.regtravelers.length > 0){
          this.testTravelers();
        }
        if (this.regIncomplete == false) {
          let regApp = this;
          // Save user
          slideLeft("#register-loader");
          fadeOut("#reg-fs-three");
          $.ajax({
            type: "POST",
            url: '/register',
            data: { user : regApp.reguser  },
            success: function(response){
              // Save travelers
              if (regApp.regtravelers.length > 0) {
                $.ajax({
                  type: "POST",
                  url: '/newtraveler',
                  data: { travelers : regApp.regtravelers, user : response, len : regApp.numTravelers },
                  success: function(response){
                      // Display success message
                      setTimeout(function(){
                        fadeOut("#register-loader");
                        slideLeft("#register-success");
                      },2000);
                  },
                  error: function (request, status, error) {
                    // console.log(request.responseText);
                  }
                });
              } else {
                setTimeout(function(){
                  fadeOut("#register-loader");
                  slideLeft("#register-success");
                },2000);
              }
            },
            error: function (request, status, error) {
              // console.log(request.responseText);
            }
          });
        }
			},
			clearData() {
        registerClose();
				this.submitAttempt = false;
        this.emailExists = false;
				this.numTravelers = 1;
				this.reguser = {email: "", pass: "", passconf: "", name: "",
												cell: "", home: "", street: "", zip: ""};
				this.regtravelers = [{name: "", gender: "", relate: "", emerg: "", ephn: "", dob: ""}];
				this.$refs.traveler[0].hasWarning = false;
				this.$refs.traveler[0].hasSubmit = false;
				validator.hideError(['reg-trav0-fullname', 'reg-trav0-gender', 'reg-trav0-relate',
			 											'reg-trav0-emerg', 'reg-trav0-ephn',]);
        $('#traveler-modal0').css('max-height', '450px');
        $('#traveler-modal0-details').css('bottom', '0px');
        $('#traveler-modal0').addClass('active');
			},
			verifyEmail() {
        let regApp = this;
        $.ajax({
          type: "GET",
          url: '/precheck',
          data: {email: this.reguser.email},
          success: function(response){
              if (response === "OPEN"){
                regApp.emailExists = false;
              } else {
                regApp.emailExists = true;
              }
          }
        })
        if (this.emailExists == false) {
           return false;
        } else {
          return true;
        }
			}
		},
		mounted() {
      $('#traveler-modal0').css('max-height', '450px');
      $('#traveler-modal0-details').css('bottom', '0px');
      $('#traveler-modal0').addClass('active');
		},
		components: {
			TravelerModal,
      SuccessModal,
      LoadingModal
		}
});


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
			regtravelers: [{name: "", gender: "", relate: "", emerg: "", ephn: ""}]
		},
		methods: {
			insertTraveler(){
				this.regtravelers.push({name: "", gender: "", relate: "", emerg: "", ephn: ""});
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
            errTotal += this.$children[i].warnings.length;
          }
          console.log(errTotal);
          if (errTotal > 0) {
            this.regIncomplete = true;
          } else {
            this.regIncomplete = false;
          }
      },
			sendData() {
        this.submitAttempt = true;
        if (this.regtravelers.length > 0){
          this.regIncomplete = false;
  				for (let i = 0; i < this.numTravelers; i++){
  					this.$children[i].hasSubmit = true;
  					this.$children[i].testError({elem: 'reg-trav' + i + '-fullname', type: 'string'});
  					this.$children[i].testError({elem: 'reg-trav' + i + '-gender', type: 'select'});
  					this.$children[i].testError({elem: 'reg-trav' + i + '-relate', type: 'select'});
  					this.$children[i].testError({elem: 'reg-trav' + i + '-emerg', type: 'string'});
  					this.$children[i].testError({elem: 'reg-trav' + i + '-ephn', type: 'phone'});
  				}
        }
        if (this.regIncomplete == false) {
          let regApp = this;
          // Save user
          slideLeft("#register-loader");
          fadeOut("#reg-fs-three");
          $.ajax({
            type: "POST",
            url: '/regNewUser',
            data: { user : regApp.reguser  },
            success: function(response){
              // Save travelers
              if (regApp.regtravelers.length > 0) {
                $.ajax({
                  type: "POST",
                  url: '/regNewTraveler',
                  data: { travelers : regApp.regtravelers, user : response, len : regApp.numTravelers },
                  success: function(response){
                      // Display success message
                      setTimeout(function(){
                        fadeOut("#register-loader");
                        slideLeft("#register-success");
                      },2000);
                  },
                  error: function (request, status, error) {
                    console.log(request.responseText);
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
              console.log(request.responseText);
            }
          });
        }
			},
			clearData() {
        registerClose();
				this.submitAttempt = false;
				this.numTravelers = 1;
				this.reguser = {email: "", pass: "", passconf: "", name: "",
												cell: "", home: "", street: "", zip: ""};
				this.regtravelers = [];
        this.insertTraveler();
				this.$children[0].hasWarning = false;
				this.$children[0].hasSubmit = false;
				validator.hideError(['reg-trav0-fullname', 'reg-trav0-gender', 'reg-trav0-relate',
			 											'reg-trav0-emerg', 'reg-trav0-ephn',])
			},
      closeAll(){
        fadeOut("#register-success");
        this.clearData();
        setTimeout(function() {
          slideLeft("#reg-fs-three");
        }, 300);
      },
			verifyEmail() {
        let regApp = this;
        $.ajax({
          type: "GET",
          url: '/regPrecheck',
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

		},
		components: {
			TravelerModal,
      SuccessModal,
      LoadingModal
		}
});

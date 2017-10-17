window.Vue = require('vue');

const bus = new Vue();

// Account view controller
const accountApp = new Vue({
    el: '#admin-app',
    data: {
    },
    methods: {
      // updateUserData(check){
      //     $.ajax({
      //         type: "POST",
      //         url: '/profile/user/update',
      //         data: { user : acctApp.userDetails, id : authUsr.id },
      //         success: function(data){
      //         }
      //     });
      // },
      // showPaymentModal(){
      //   bus.$emit("PAYMENT");
      // }
    },
    mounted() {
      // do this when ready
    },
		components: {
		},
    computed: {
      // computed data
    }
});

// Change email/password view controller

const overlayApp = new Vue({
    el: '#dark-overlay',
    data: {
      // newConfidential: false,
    },
    methods: {
      confidentialClose(){
        // this.newConfidential = false;
      }
    },
    mounted() {
      // bus.$on('CONFIDENTIAL', ()=> this.newConfidential = true);
    },
    components: {
      // ConfidentialModal,
    },
    computed: {
      // computed data
    }
});

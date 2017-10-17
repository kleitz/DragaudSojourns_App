window.Vue = require('vue');

const bus = new Vue();

// Account view controller
const accountApp = new Vue({
    el: '#admin-app',
    data: {
      groupDetails: false,
      groupPackages: [
        {name: 'Single', cost: ''},
      ],
      group: {number: '', destination: '', depart: '', return: '', school: '',
              packages: '', icon: '', itinerary: '', release: '', message: ''}
    },
    methods: {
      updateItinerary(event){
        this.group.itinerary = event.target.files[0];
      },
      updateIcon(event){
        this.group.icon = event.target.files[0];
      },
      updateRelease(event){
        this.group.release = event.target.files[0];
      },
      updateDates(){
        this.group.depart = $("#group-depart").val();
        this.group.return = $("#group-return").val();
        this.group.packages = JSON.stringify(this.groupPackages);
        if (this.group.number != '' && this.group.destination != '' && this.group.depart != '' && this.group.return != '' && this.group. school != '' &&
                this.group.packages != '' && this.group.icon != '' && this.group.itinerary != '' && this.group.release != '' && this.group.message != '')
          {
            this.groupDetails = true;
          } else {
            this.groupDetails = false;
          }
      },
      insertPackage(){
        this.groupPackages.push({name: '', cost: ''});
      },
      removePackage(index){
        this.groupPackages.splice(index, 1);
      }
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

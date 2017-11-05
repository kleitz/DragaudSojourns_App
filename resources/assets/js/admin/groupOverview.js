const groupTravelersApp = new Vue({
    el: '#group-travelers-app',
    data: {
      trips: '',
      group: groupLoaded,
      depart: groupDepart,
      admin: adminLoaded,
      method: 'Payment',
      today: '',
      paymentValid: false,
      paymentType: 'discount',
      payment: {
          traveler: '', user: '',
          method: '', paypal_id: 'Administrator Payment',
          user_id: '', trip_id: '',
          amount: '0.00', fee: 0,
          balance: '', balanceIn: '',
      },
    },
    methods: {
      resetData(){
        // let tL = JSON.stringify(tripsLoaded);
        // this.trips = JSON.parse(tL);
        this.payment = {
            traveler: '', user: '',
            method: '', paypal_id: '',
            user_id: '', trip_id: '',
            amount: '0.00', fee: 0,
            balance: '', balanceIn: '',
            created_at: '',
        };
      },
      adminPayment(index){
        fadeIn('#poverlay');
        fadeIn('#payment-modal');
        this.updatePayment();
        this.payment.balanceIn = this.trips[index].total - this.trips[index].paid;
        this.payment.balance = this.formatCurrency(this.payment.balanceIn);
        this.payment.amount = '0.00';
        this.payment.paypal_id = 'admin-' + Date.now();
        this.payment.traveler = this.trips[index].traveler;
        this.payment.traveler_id = this.trips[index].traveler.id;
        this.payment.user = this.trips[index].user;
        this.payment.user_id = this.trips[index].user.id;
        this.payment.trip_id = this.trips[index].id;
        this.createToday();
        this.formatCreated(this.today);
      },
      updatePayment(){
        this.payment.balance = this.payment.balanceIn - this.payment.amount;
        if (this.payment.amount > this.payment.balanceIn) {
          this.payment.balance = 0;
          this.payment.amount = this.payment.balanceIn;
        }
        this.checkPayment();
      },
      selectDiscount(){
        this.method = 'Discount';
      },
      selectPayment(){
        this.method = 'Payment';
      },
      updateDate(){
        this.formatCreated($('#payment-date').val());
        this.checkPayment();
      },
      checkPayment(){
        if (this.payment.amount > 0 && this.payment.method != ''){
          this.paymentValid = true;
        } else {
          this.paymentValid = false;
        }
      },
      processPayment(){
        let dataUrl = '/payments/store';
        let payApp = this;
        if (this.method == 'Discount') {
            dataUrl = '/payments/discount';
        }
        $.ajax({
            type: "POST",
            url: dataUrl,
            data: { payment : payApp.payment},
            success: function(data){
              let response = JSON.parse(data);
              if (response.status == "SUCCESS") {
                window.location.reload();
              }
            }
        });
      },
      formatCurrency(val){
          return parseFloat(Math.round(val * 100) / 100).toFixed(2);
      },
      closePayment(){
        fadeOut('#poverlay');
        fadeOut('#payment-modal');
        this.resetData();
      },
      createToday(){
        today = new Date();
        dd = today.getDate();
        if (dd < 10) { dd = '0' + dd };
        mm = today.getMonth() + 1;
        if (mm < 10) { mm = '0' + mm};
        yy = today.getFullYear();
        this.today = mm + '/' + dd + '/' + yy;
      },
      formatCreated(date){
        let dateExp = date.split('/');
        console.log(dateExp[0]);
        this.payment.created_at = dateExp[2] + '-' + dateExp[0] + '-' + dateExp[1] + ' 00:00:00';
      },
      toggleActive(index){
        let active = this.trips[index].active;
        if (active == 0) this.trips[index].active = 1;
        if (active == 1) this.trips[index].active = 0;
        let trip = this.trips[index];
        $.ajax({
            type: "POST",
            url: '/trips/toggleActive',
            data: { id: trip.id, active: trip.active},
            success: function(data){
              trip.active = data;
            }
        });
      }
      // app-wise functions
    },
    mounted() {
      let tL = JSON.stringify(tripsLoaded);
      this.trips = JSON.parse(tL);
      this.resetData();
      $('#payment-date').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome'
        });
      let payApp = this;
      $('#payment-date').change(function(){
        payApp.updateDate();
      })
      $('#payment-date').attr('readonly', 'readonly')
      $('#payment-date').css('background', 'white')
      // do this when ready
    },
    components: {
      // all imported / created compenents
    },
    computed: {
      remainingBalance(){
        return this.formatCurrency(this.payment.balance);
      },
    }
});

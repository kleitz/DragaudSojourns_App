function bindAdminHelpers(){
  $(document).mouseup(function(e)
  {
      var container = $(".admin-helper-modal");
      if (!container.is(e.target) && container.has(e.target).length === 0)
      {
        $(".show-account-user").removeClass('active');
        $('.admin-helper-modal').addClass('hidden');
      }
  });
  $(".show-account-user").mouseover(function(){
    if (!$(this).hasClass('active')){
      $(".show-account-user").removeClass('active');
      $('.admin-helper-modal').addClass('hidden');
    }
    let modal = $(this).children('.admin-helper-modal');
    let helper = $(this).find('.fix-helper');
    modal.removeClass('hidden');
    helper.css('top', modal.offset().top - $(window).scrollTop() - 25);
    helper.css('left', modal.offset().left + 25);
  });
  $(".show-account-user").mouseleave(function(){
    if (!$(this).hasClass('active'))
    $(this).children('.admin-helper-modal').addClass('hidden');
  });
  $(".show-account-user").click(function(){
    $(".show-account-user").removeClass('active');
    $('.admin-helper-modal').addClass('hidden');
    $(this).addClass('active');
    $(this).children('.admin-helper-modal').removeClass('hidden');
  });
}

const groupPaymentsApp = new Vue({
    el: '#group-payments-app',
    data: {
      admin: authAdmin,
      paymentsIn: '',
      paymentsOut: [],
      paymentsTotal: 0,
      feesTotal: 0,
      groupBegin: groupDate,
      dateBegin: '',
      dateEnd: '',
      minRange: 8,
      // Stored data
    },
    methods: {
      // app-wise functions
      formatCurrency(val){
        return parseFloat(Math.round(val * 100) / 100).toFixed(2);
      },
      updateRange(){
        let payApp = this;
        setTimeout(function(){
          payApp.dateBegin = $('#payment-begin').val();
          payApp.dateEnd = $('#payment-end').val();
          payApp.filterPayments();
        }, 100);
      },
      toDate(dateStr) {
        var parts = dateStr.split("/");
       return new Date(parts[2], parts[0] - 1, parts[1]);
      },
      filterPayments(){
        this.paymentsOut = [];
        this.paymentsTotal = 0;
        this.feesTotal = 0;
        for (let i = 0; i < this.paymentsIn.length; i++){
          let pI = this.paymentsIn[i];
          let dI = this.toDate(pI.date);
          let dB = this.toDate(this.dateBegin);
          let dE = this.toDate(this.dateEnd);
          if (dI >= dB && dI <= dE){
            this.paymentsOut.push(pI);
            this.paymentsTotal += parseFloat(pI.amount);
            this.feesTotal += parseFloat(pI.fee);
          }
        }
        this.paymentsTotal = this.formatCurrency(this.paymentsTotal);
        this.feesTotal = this.formatCurrency(this.feesTotal);
        mL = 8 - this.paymentsOut.length;
        this.minRange = (mL > 0) ? mL : 0;
        var interval = setInterval(function () {
            if ($('.admin-helper-modal').length) {
                bindAdminHelpers();
            }
        }, 100);
      }
    },
    mounted() {
      let pL = JSON.stringify(paymentsLoaded);
      this.paymentsIn = JSON.parse(pL);

      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1;
      var yy = today.getFullYear();
      if(dd<10){ dd='0'+dd; }
      if(mm<10){ mm='0'+mm; }
      var today = mm +'/'+dd+'/'+yy;

      this.dateBegin = this.groupBegin;
      this.dateEnd = today;
      this.filterPayments();
      $('#payment-begin').val(this.groupBegin);
      $('#payment-end').val(today);
      $('#payment-begin').datepicker({
              uiLibrary: 'bootstrap4',
              iconsLibrary: 'fontawesome'
      });
      $('#payment-end').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome'
        });
      let payApp = this;
      $('#payment-end, #payment-begin').change(function(){
        payApp.updateRange();
      })
    },
    components: {
      // all imported / created compenents
    },
    computed: {

    }
});

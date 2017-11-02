window.Vue = require('vue');
import IconSelect from './components/IconSelect.vue';

function scrubIcon(x){
  let fIcon = x.split('/');
  fIcon = fIcon[fIcon.length-1];
  let iExt = fIcon.indexOf('EXT');
  let iTime = fIcon.indexOf('TIME');

  return fIcon.slice(0, iTime) + fIcon.slice(iExt+3);
}

function scrubUpload(x){
  let fIcon = x.split('/');

  return fIcon = fIcon[fIcon.length-1];
}


const focusApp = new Vue({
    el: '#group-focus-app',
    data: {
      groupEdit: false,
      groupIn: '',
      groupOut: '',
      groupIcon: '',
      iconDisplay: '',
      groupDetails: true,
      groupPackages: '',
    },
    methods: {
      emitEdit(){
        fadeIn('#goverlay');
        let groupApp = this;
        this.groupEdit = true;
        var interval = setInterval(function () {
            if ($('#group-depart').length) {
                clearInterval(interval);
                bindUploads();
                $('#group-depart').datepicker({
                        uiLibrary: 'bootstrap4',
                        iconsLibrary: 'fontawesome'
                    });
                $('#group-return').datepicker({
                      uiLibrary: 'bootstrap4',
                      iconsLibrary: 'fontawesome'
                  });
                  $('#group-depart, #group-return').change(function(){
                    groupApp.updateData();
                  });

                $('#group-icon').html(scrubIcon(groupApp.groupIn.icon));
                $('#group-itinerary').html(scrubUpload(groupApp.groupIn.itinerary));
                $('#group-release').html(scrubUpload(groupApp.groupIn.release));
            }
        }, 100);
      },
      cancelEdit(){
        fadeOut('#goverlay');
        this.groupEdit = false;
        this.resetData();
      },
      insertPackage(){
        bindFormatters();
        this.groupPackages.push({name: '', cost: ''});
        this.testData();
      },
      removePackage(index){
        this.groupPackages.splice(index, 1);
        this.testData();
      },
      checkPackages(){
        for (let i = 0; i < this.groupPackages.length; i++){
          if (this.groupPackages[i].name == '')
            return false;
          if (this.groupPackages[i].cost <= 0 || this.groupPackages[i].cost == '')
            return false;
        }
        return true;
      },
      formatCurrency(index, event){
        this.groupPackages[index].cost = parseFloat(Math.round(event.target.value * 100) / 100).toFixed(2);
        this.testData();
      },
      updateItinerary(event){
        $('#group-itinerary').html('');
        this.testData();
        this.groupOut.itinerary = event.target.files[0];
      },
      updateRelease(event){
        $('#group-release').html('');
        this.testData();
        this.groupOut.release = event.target.files[0];
      },
      updateData(){
        this.groupOut.packages = JSON.stringify(this.groupPackages);
        this.groupOut.depart = $("#group-depart").val();
        this.groupOut.return = $("#group-return").val();
        this.testData();
      },
      testData(){
        if (this.groupOut.destination != '' && this.checkPackages() == true &&
            this.groupOut.depart != '' && this.groupOut.return != '' &&
            this.groupOut.school != '' && this.groupOut.icon != '' &&
            this.groupOut.itinerary != '' && this.groupOut.itinerary != undefined &&
            this.groupOut.release != '' && this.groupOut.release != undefined &&
            this.groupOut.message != ''){
          this.groupDetails = true;
        } else {
          this.groupDetails = false;
        }
      },
      resetData(){
        let gL = JSON.stringify(groupLoaded);
        this.groupIn = JSON.parse(gL);
        this.groupOut = JSON.parse(gL);
        this.groupPackages = JSON.parse(this.groupIn.packages);

        this.iconDisplay = scrubIcon(groupLoaded.icon);
        this.groupIn.message = this.groupIn.message.slice(0, 80);
        this.groupIcon = '';
        this.groupDetails = true;
        $('#group-icon').html('');
        $('#group-itinerary').html('');
        $('#group-release').html('');
        var interval = setInterval(function () {
            if ($('.gfocus-icon-container').length) {
                clearInterval(interval);
                $(".gfocus-icon-container").mouseover(function(){
                  $("#gfocus-icon-show").removeClass('hidden');
                })
                $(".gfocus-icon-container").mouseleave(function(){
                  $("#gfocus-icon-show").addClass('hidden');
                })
            }
        }, 100);
      },
      showIconSelect(){
        let mount = $('#iconselect-mount').offset();
        $("#icon-select").css('top', mount.top - $(window).scrollTop() - 50);
        $("#icon-select").css('left', mount.left + 430);
        $(document).scroll(function(){
          $("#icon-select").css('top', mount.top - $(window).scrollTop() - 50);
        })
        let groupApp = this;
        setTimeout(function(){
          groupApp.$refs.iconselect.iconLoading = false;
        },1000);
        slideLeft('#icon-select');
      },
      hideIconSelect(){
        this.$refs.iconselect.iconLoading = true;
        fadeOut('#icon-select');
      },
      updateIconLoc(data){
        this.groupOut.icon = data;
      },
      updateIconName(data){
        this.groupIcon = data;
        this.testData();
        $('#group-icon').html('');
      }
    },
    mounted() {
      this.resetData();
    },
    components: {
      IconSelect,
    },
    computed: {
    }
});

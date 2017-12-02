window.Vue = require('vue');

const bus = new Vue();
import IconSelect from './components/IconSelect.vue';

// Group create app
const groupCreateApp = new Vue({
    el: '#group-create-app',
    data: {
      groupExists: false,
      groupIcon: '',
      previewIcon: {
        background: '',
      },
      groupDetails: false,
      groupPackages: [
        {name: 'Single', cost: ''},
      ],
      examplePackage: '0.00',
      group: {number: '', destination: '', depart: '', return: '', school: '',
              packages: '', icon: '', itinerary: '', release: '', message: ''}
    },
    methods: {
      groupPrecheck(){
        let groupApp = this;
        $.ajax({
              type: "GET",
              url: '/groups/precheck',
              data: {number: groupApp.group.number},
              success: function(data){
                if (data == 'OPEN') {
                  groupApp.groupExists = false;
                } else if (data == 'TAKEN') {
                  groupApp.groupExists = true;
                }
              }
          });
          this.updateDates();
      },
      groupValid(){
        if (this.group.number != '' && this.groupExists == false && this.group.destination != '' &&
            this.group.depart != '' && this.group.return != '' && this.group.school != '' &&
            this.checkPackages() == true && this.group.icon != '' && this.group.itinerary != '' &&
            this.group.itinerary != undefined && this.group.release != undefined && this.group.release != '' &&
            this.group.message != '' )
          {
            this.groupDetails = true;
          } else {
            this.groupDetails = false;
          }
      },
      formatCurrency(index, event){
        this.groupPackages[index].cost = parseFloat(Math.round(event.target.value * 100) / 100).toFixed(2);
        this.groupValid();
      },
      updateItinerary(event){
        this.groupValid();
        this.group.itinerary = event.target.files[0];
      },
      updateRelease(event){
        this.groupValid();
        this.group.release = event.target.files[0];
      },
      updateDates(){
        this.group.depart = $("#group-depart").val();
        this.group.return = $("#group-return").val();
        this.group.packages = JSON.stringify(this.groupPackages);
        this.groupValid();
      },
      insertPackage(){
        bindFormatters();
        this.groupPackages.push({name: '', cost: ''});
      },
      removePackage(index){
        this.groupPackages.splice(index, 1);
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
      showIconSelect(){
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
        this.group.icon = data;
        if (this.group.icon == ''){
          this.previewIcon.background = 'url(/assets/images/icons/default.jpg)';
        } else {
          this.previewIcon.background = 'url(/' + data + ')';
        }
      },
      updateIconName(data){
        this.groupIcon = data;
      }
    },
    mounted() {
      let groupApp = this;
      $("#group-depart, #group-return").on('change keyup click', function(){
        groupApp.updateDates();
      });
    },
		components: {
      IconSelect,
		},
    computed: {
      // computed data
    }
});

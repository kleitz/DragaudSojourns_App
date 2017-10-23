window.Vue = require('vue');

const bus = new Vue();

// Group create app
const groupCreateApp = new Vue({
    el: '#group-create-app',
    data: {
      newIcon: '',
      deleteMode: 0,
      iconList: iconListLoaded,
      iconLoading: true,
      groupExists: false,
      groupIcon: '',
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
            this.group.release != '' && this.group.message != '' )
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
          groupApp.iconLoading = false;
        },1000);
        slideLeft('#icon-select');
      },
      hideIconSelect(){
        this.iconLoading = true;
        this.deleteMode = 0;
        fadeOut('#icon-select');
      },
      selectIcon(index, event){
        // DELETE ICON OPTION
        if (this.deleteMode == 1){
          this.iconLoading = true;
          let fIcon = this.iconList[index].loc.split('/');
          fIcon = fIcon[fIcon.length-1];
          this.deleteIcon(fIcon, index);
        // SELECT ICON OPTION
        } else {
          let icon = event.target.value;
          let fIcon = icon.split('/');
          fIcon = fIcon[fIcon.length-1];
          iExt = fIcon.indexOf('EXT');
          iTime = fIcon.indexOf('TIME');
          time = new Date(fIcon.slice(iTime + 4, iExt) * 1000);
          time = '-' + (time.getMonth() + 1) + '-' + time.getDate() + '-' + time.getFullYear();

          fIcon = fIcon.slice(0, iTime) + fIcon.slice(iExt+3);

          this.group.icon = icon;
          this.groupIcon = fIcon;
          this.hideIconSelect();
        }
      },
      uploadNewIcon(event){
        let groupApp = this;
        this.iconLoading = true;

        event.preventDefault();
        let formData = new FormData;
        formData.append('file', event.target.files[0]);
        $.ajax({
              type: "POST",
              url: '/admin/icon/store',
              processData: false,
              contentType: false,
              cache: false,
              data: formData,
              dataType: 'JSON',
              statusCode: {
                200: function (response) {
                   let icon = response.responseText;
                   let fIcon = icon.split('/');
                   fIcon = fIcon[fIcon.length-1];
                   iExt = fIcon.indexOf('EXT');
                   iTime = fIcon.indexOf('TIME');
                   fIcon = fIcon.slice(0, iTime) + fIcon.slice(iExt+3);

                   groupApp.iconList.push({loc: icon, name: fIcon});
                   setTimeout(function(){
                     groupApp.iconLoading = false;
                     groupApp.deleteMode = 0;
                   },1000);
                },
             },
          });
      },
      deleteIcon(name, index){
        let groupApp = this;
        $.ajax({
              type: "POST",
              url: '/admin/icon/destroy',
              data: {icon: name},
              success: function(data){
                groupApp.deleteSuccess = true;
                groupApp.iconList.splice(index, 1);
                groupApp.group.icon = '';
                groupApp.groupIcon = '';
                setTimeout(function(){
                  groupApp.iconLoading = false;
                },1000);
              }
          });
      },
      deleteToggle(){
        if (this.deleteMode == 1) {
          this.deleteMode = 0;
        } else {
          this.deleteMode = 1;
        }
      }
    },
    mounted() {
      let groupApp = this;
      $("#group-depart, #group-return").on('change keyup click', function(){
        groupApp.updateDates();
      })
      for (let i = 0; i < this.iconList.length; i++){
          let fIcon = this.iconList[i].split('/');
          fIcon = fIcon[fIcon.length-1];
          iExt = fIcon.indexOf('EXT');
          iTime = fIcon.indexOf('TIME');
          fIcon = fIcon.slice(0, iTime) + fIcon.slice(iExt+3);

          this.iconList[i] = {loc: this.iconList[i], name: fIcon};
      }
    },
		components: {
		},
    computed: {
      // computed data
      deleteMessage(){
        if (this.deleteMode == 1)
          return "Cancel";
        if (this.deleteMode == 0)
          return "Delete icon";
      }
    }
});

// Change email/password view controller

// const overlayApp = new Vue({
//     el: '#dark-overlay',
//     data: {
//       // newConfidential: false,
//     },
//     methods: {
//       confidentialClose(){
//         // this.newConfidential = false;
//       }
//     },
//     mounted() {
//       // bus.$on('CONFIDENTIAL', ()=> this.newConfidential = true);
//     },
//     components: {
//       // ConfidentialModal,
//     },
//     computed: {
//       // computed data
//     }
// });

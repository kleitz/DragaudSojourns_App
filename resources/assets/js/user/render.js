window.Vue = require('vue');
let profileElem = ['usr-email', 'usr-street', 'usr-zip', 'usr-home', 'usr-cell'];
let profileCx = document.getElementsByClassName('profile-success');

import TravelerModal from './components/TravelerModal.vue';

// import Template from './Template.vue';

const accountApp = new Vue({
    el: '#accountApp',
    data: {
      userExpand: false,
      userErr: {email: {v: false, e: 'usr-email', t: 'email'},
                street: {v: false, e: 'usr-street', t: 'string'},
                zip: {v: false, e: 'usr-zip', t: 'zip'},
                cell: {v: false, e: 'usr-cell', t: 'phone'},
                home: {v: false, e: 'usr-home', t: 'phone'}
              },
      userDetails: authUsr,
      userTravelers: authTravs,
    },
    methods: {
      userDetailsExpand(){
        for (let i = 0; i < profileCx.length; i++){
          $(profileCx[i]).addClass('opaque');
        }
        let link = $("#profile-expand");
        let el = this.userErr;
        let profileErr = [
              {elem: el.email.e, type: el.email.t},
              {elem: el.street.e, type: el.street.t},
              {elem: el.zip.e, type: el.zip.t}
            ];
        if (this.userDetails.home || (!this.userDetails.cell && !this.userDetails.home))
            profileErr.push({elem: el.home.e, type: el.home.t});
        if (this.userDetails.cell || (!this.userDetails.cell && !this.userDetails.home))
            profileErr.push({elem: el.cell.e, type: el.cell.t});
        let check = validator.isValid(profileErr);
        if (link.text() == 'Save changes') {
          if (this.userDetails.email != authUsr.email) {
            this.updateUserDataEmail(check);
          } else {
            this.updateUserData(check);
          }
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
          acctApp.hideErrEmail();
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
      updateUserDataEmail(check){
        let acctApp = this;
        $.ajax({
            type: "GET",
            url: '/precheck',
            data: { email : acctApp.userDetails},
            success: function(data) {
              if (data == "OPEN")
                acctApp.updateUserData(check);
              if (data == "TAKEN")
                acctApp.showErrEmail();
            }
        });
      },
      userDetailsClear(){
        this.hideErrEmail();
        openExpander($("#profile-details"));
        validator.hideError(profileElem);
        this.userExpand = false;
        $("#profile-expand").text('Edit your profile');
        this.userDetails = {email: authUsr.email, street: authUsr.street, zip: authUsr.zip, cell: authUsr.cell, home: authUsr.home};
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
      showErrEmail(){
        slideLeft('#err-email-helper');
      },
      hideErrEmail(){
        fadeOut('#err-email-helper');
      },
      alert(){
        alert('yay');
      },
      validate(el){
        if(el.v == true) {
          validator.hideError(profileElem);
          validator.isValid([{elem: el.e, type: el.t}]);
        }
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

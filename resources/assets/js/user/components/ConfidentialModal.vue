<template id="confidential-modal-template">
  <div class="flex-abs-center abs-fill">
    <div id="confidential-wrapper" class="panel panel-secure">
      <div class="panel-heading flex-row-between">
        <h2 class="panel-title flex-col-center">Change email / password</h2>
        <span class="modal-ds-close pointer" @click="closeMe">X</span>
      </div>
      <div class="panel-body">
        <form>
          <div class="form-group">
            <label for="email">New email</label>
            <input v-model="resetData.email" type="text" name="email" v-bind:class="{'input-add-errparent' : emailExists, 'register-input form-control' : true}" id="conf-email" @keyup="verifyEmail" @change="verifyEmail">
            <div class="input-add-err" v-if="emailExists == true">
        			<input class="ds-form-error ds-details-err" readonly type="text" value="This email is being used by another user. Please choose another">
        				<img src="/assets/images/icons/hazard_tri.png" class="input-hazard"/>
        			</input>
        		</div>
            <span id="conf-email-err" class="text-left ds-form-errmsg">Please enter a valid email</span>
          </div>
          <div class="form-group">
            <label for="password">New password</label>
            <div class="input-group">
              <input @keyup="testErrors" v-model="resetData.password" type="text" name="password" class="form-control pass-format" id="conf-password">
              <div class="input-group-addon pass-reveal"><img src="/assets/images/icons/eye.png"/></div>
            </div>
            <span id="conf-password-err" class="text-left ds-form-errmsg" style="top: 0; margin-bottom: 0px;">Must be 8 characters long with one uppercase letter and one number.</span>
          </div>
          <div class="form-group">
            <label for="passwordconf">Confirm password</label>
            <div class="input-group">
              <input @keyup="testErrors" v-model="confPass" type="text" name="password-conf" class="form-control pass-format" id="conf-passwordconf">
              <div class="input-group-addon pass-reveal"><img src="/assets/images/icons/eye.png"/></div>
            </div>
            <span id="conf-passwordconf-err" class="text-left ds-form-errmsg" style="top: 0; margin-bottom: 0px;">Passwords do not match</span>
          </div>
          <div class="flex-row-between" style="margin-top: 20px">
            <button id="reg-submit" type="button" name="submit" class="ds-button button-gen waves-effect" value="Submit" @click="saveChanges">
        			Save changes
        		</button>
            <button id="reg-submit" type="button" name="submit" class="ds-button button-cancel waves-effect" value="Submit" @click="closeMe">
        			Cancel
        		</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Saving updates -->
    <loading-modal :id="'confidential-loader'">
      <template slot="header">Please wait...</template>
      <template slot="message">We're updating your information</template>
    </loading-modal>
    <!-- Update successful-->
    <success-modal :id="'confidential-success'" :button="'Continue'" :sub="false" :subxs="false">
      <template slot="header">Account updated!</template>
      <template slot="message">Close this box or press continue to proceed.</template>
    </success-modal>
  </div>
</template>

<script>
import LoadingModal from './LoadingModal.vue';
import SuccessModal from './SuccessModal.vue';

export default {
  	template: "#confidential-modal-template",
  	props : [],
  	data() {
  		return {
          hasErrors: false,
          hasSubmit: false,
          emailExists: false,
          confPass: "",
          resetData: {
            email: authUsr.email,
            password: '',
          }
  		}
  	},
  	methods: {
      closeMe(){
        this.$emit('close');
        fadeOut("#dark-overlay");
        zoomOut("#confidential-modal");
      },
      testErrors(){
        if (this.hasSubmit == true){
          let checkErr = validator.isValid([
            {elem: "conf-email", type: 'email'},
            {elem: "conf-password", type: 'strongpass'},
          ]);
          if (checkErr != true || this.resetData.password != this.confPass){
            this.hasErrors = true;
          } else {
            this.hasErrors = false;
          }
          if (this.resetData.password != this.confPass){
            validator.showError(['conf-passwordconf']);
          } else {
            validator.hideError(['conf-passwordconf']);
          }
        }
      },
      verifyEmail(){
        this.testErrors();
        let confApp = this;
        if (this.resetData.email !== authUsr.email){
          $.ajax({
            type: "GET",
            url: '/precheck',
            data: { email: confApp.resetData.email},
            success: function(response){
              if (response === "TAKEN") {
                confApp.emailExists = true;
              } else {
                confApp.emailExists = false;
              }
            }
          });
        }
      },
      saveChanges() {
        this.hasSubmit = true;
        let confApp = this;
        this.testErrors();
        if (this.hasErrors == false && this.emailExists == false) {
          zoomOut("#confidential-wrapper");
          slideLeft("#confidential-loader");
          $("#confidential-success-close, #confidential-success-button").attr("href", '/profile/' + confApp.resetData.email);
          $.ajax({
            type: "POST",
            url: '/profile/user/confidential',
            data: { user: confApp.resetData},
            success: function(response){
              setTimeout(function(){
                zoomOut("#confidential-loader");
                slideLeft("#confidential-success");
              },2000);
            }
          });
        }
      }
  	},
    mounted()  {
      bindFormatters();
    },
    components: {
      SuccessModal,
      LoadingModal
    }
  }


</script>

<style>

</style>

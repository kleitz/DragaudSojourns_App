<!-- multistep form -->
<form id="msform" class="hidden">
	<!-- progressbar -->
	<ul id="progressbar">
		<li class="active">Account Setup</li>
		<li>Personal Details</li>
		<li>Traveler Details</li>
	</ul>
	<!-- fieldsets -->
	<fieldset id="reg-fs-one" class="modal-ds-form">
    <div class="msform-close">
      <span class="modal-ds-close pointer" @click="clearData">X</span>
    </div>
		<h4 class="fs-title">Create your account</h2>
		<h4 class="fs-subtitle">Login credentials</h3>
		<!-- NEW EMAIL -->
		<input v-model="reguser.email" id="reg-new-email" class="register-input" type="text" name="email" placeholder="Email"/>
		<span id="reg-new-email-err" class="text-left ds-form-errmsg">Please enter a valid email</span>
		<!-- NEW PASSWORD -->
		<input v-model="reguser.pass" id="reg-new-pass" class="register-input" type="password" name="pass" placeholder="Password"/>
		<span id="reg-new-pass-err" class="text-left ds-form-errmsg">Password does not meet requirements</span>
		<div id="new-pass-helper" class="helper-modal hidden">
			<p>8 characters or longer.<br/>At least one number and uppercase letter</p>
		</div>
		<!-- CONFIRM PASSWORD -->
		<input v-model="reguser.passconf" id="reg-pass-confirm" class="register-input" type="password" name="cpass" placeholder="Confirm Password"/>
		<span id="reg-pass-confirm-err" class="text-left ds-form-errmsg">Passwords do not match</span>
		<!-- TO FORM 2 -->
		<input id="reg-next-acct" type="button" name="next" class="next action-button margin-auto" value="Next"/>
	</fieldset>
	<fieldset id="reg-fs-two" class="modal-ds-form">
    <div class="msform-close">
      <span class="modal-ds-close pointer" @click="clearData">X</span>
    </div>
		<h4 class="fs-title">Personal Details</h2>
		<h4 class="fs-subtitle">Tell us about yourself.</h3>
		<!-- USER NAME -->
		<input v-model="reguser.name" id="reg-new-fullname" class="register-input" type="text" name="fullname" placeholder="Full name" />
		<span id="reg-new-fullname-err" class="text-left ds-form-errmsg">Please enter your full name</span>
		<!-- USER PHONE NUMBERS -->
    <div class="flex-row-between">
  		<input v-model="reguser.cell" id="reg-new-phone" class="register-input phone-format numbers-only" type="text" name="cellphone" style="margin-right: 10px" placeholder="Cell phone"/>
  		<input v-model="reguser.home" id="reg-new-home" class="register-input phone-format numbers-only" type="text" name="homephone" />
    </div>
		<div id="new-phone-helper" class="helper-modal hidden">
			<p>10 digit phone number<br/>We require at least one</p>
		</div>
		<span id="reg-new-phone-err" class="text-left ds-form-errmsg"></span>
		<!-- USER ADDRESS -->
    <textarea v-model="reguser.street" id="reg-new-street" class="register-input" name="address" placeholder="Street address"></textarea>
		<span id="reg-new-street-err" class="text-left ds-form-errmsg">Please enter your street address</span>
		<!-- USER ZIP CODE -->
    <input v-model="reguser.zip" id="reg-new-zip" class="register-input zip-autofeed numbers-only" type="text" name="zip" placeholder="Zip"/>
		<span id="reg-zip-autofill" class="register-zf">Denver, Colorado</span>
		<span id="reg-new-zip-err" class="text-left ds-form-errmsg">Please enter a valid zip code</span>
		<!-- TO FORM 3 -->
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input id="reg-next-det" type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset id="reg-fs-three" class="modal-ds-form">
    <div class="msform-close">
      <span class="modal-ds-close pointer"  @click="clearData">X</span>
    </div>
		<h4 class="fs-title">Traveler Details</h2>
		<h4 class="fs-subtitle">Who will be traveling with us?</h3>
		<!-- NEW TRAVELER(S) -->
		<traveler-modal :traveler="regtraveler" :submit="submitAttempt" @remove="deleteTraveler(index)" v-for="(regtraveler, index) in regtravelers" v-bind:key="regtraveler.row" :id="index"></traveler-modal>
		<div class="pointer flex-row-between traveler-modal-add" @click="insertTraveler">
      <span>Add traveler</span>
      <div class="flex-arrow">
        <div></div>
        <div></div>
      </div>
    </div>
		<a href="javascript:;" id="reg-no-travelers" class="free-link">Not sure yet? Click here to add travelers later</a>
		<!-- SUBMIT -->
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input id="reg-submit" type="submit" name="submit" class="submit action-button" value="Submit" @click="sendData"/>
	</fieldset>
</form>

<template id="traveler-modal-template">
	@include('partials.user.traveler_info')
</template>

<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
<script>
var TravelerModal = {
	template: "#traveler-modal-template",
	props : ['id', 'traveler', 'submit'],
	data: function() {
		return {
			hasWarning: false,
			hasSubmit: false,
			warnings: [],
			genderIn: ['Male', 'Female', 'Other'],
			relateIn: ['Myself', 'Family', 'Spouse', 'Other']
		};
	},
	methods: {
		testError(obj) {
			if (this.submit == true) hasSubmit = true;
				if (this.hasSubmit == true) {
					let checkValid = validator.isValid([obj]);
					if (checkValid != true) {
							if (!this.warnings.includes(obj.elem))
								this.warnings.push(obj.elem);
					} else {
							Vue.delete(this.warnings, this.warnings.indexOf(obj.elem));
					}
					(this.warnings.length > 0) ? this.hasWarning = true : this.hasWarning = false ;
				}
		},
		expand(event) {
			bindTravelerModal($(event.target));
		},
		expandMe(event) {
			bindTravelerModal($(event.target).parent());
		},
		formatPhone() {
			$('.phone-format').mask('(000)000-0000');
		}
	}
}

const regApp = new Vue({
    el: '#msform',
    data: {
			submitAttempt: false,
			numTravelers: 1,
			reguser: {email: "jvannatta88@gmail.com", pass: "Quasar88", passconf: "Quasar88", name: "Josh Van Natta",
								cell: "(720) 412-2575", home: "", street: "1350 Grant St", zip: "80202"},
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
			sendData() {
				this.submitAttempt = true;
				for (let i = 0; i < this.numTravelers; i++){
					this.$children[i].hasSubmit = true;
					this.$children[i].testError({elem: 'reg-trav' + i + '-fullname', type: 'string'});
					this.$children[i].testError({elem: 'reg-trav' + i + '-gender', type: 'select'});
					this.$children[i].testError({elem: 'reg-trav' + i + '-relate', type: 'select'});
					this.$children[i].testError({elem: 'reg-trav' + i + '-emerg', type: 'string'});
					this.$children[i].testError({elem: 'reg-trav' + i + '-ephn', type: 'phone'});
				}
			},
			clearData() {
				this.submitAttempt = false;
				this.numTravelers = 1;
				this.reguser = {email: "", pass: "", passconf: "", name: "",
												cell: "", home: "", street: "", zip: ""};
				this.regtravelers = [{name: "", gender: "", relate: "", emerg: "", ephn: ""}];
				this.$children[0].hasWarning = false;
				this.$children[0].hasSubmit = false;
				validator.hideError(['reg-trav0-fullname', 'reg-trav0-gender', 'reg-trav0-relate',
			 											'reg-trav0-emerg', 'reg-trav0-ephn',])
			}
		},
		mounted() {

		},
		components: {
			'traveler-modal' : TravelerModal
		}
});
</script>

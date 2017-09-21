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
      <span class="modal-ds-close pointer">X</span>
    </div>
		<h4 class="fs-title">Create your account</h2>
		<h4 class="fs-subtitle">Login credentials</h3>
		<!-- NEW EMAIL -->
		<input v-model="regnewemail" id="reg-new-email" class="register-input" type="text" name="email" placeholder="Email"/>
		<span id="reg-new-email-err" class="text-left ds-form-errmsg">Please enter a valid email</span>
		<!-- NEW PASSWORD -->
		<input v-model="regnewpass" id="reg-new-pass" class="register-input" type="password" name="pass" placeholder="Password"/>
		<span id="reg-new-pass-err" class="text-left ds-form-errmsg">Password does not meet requirements</span>
		<div id="new-pass-helper" class="helper-modal hidden">
			<p>8 characters or longer.<br/>At least one number and uppercase letter</p>
		</div>
		<!-- CONFIRM PASSWORD -->
		<input v-model="regconfpass" id="reg-pass-confirm" class="register-input" type="password" name="cpass" placeholder="Confirm Password"/>
		<span id="reg-pass-confirm-err" class="text-left ds-form-errmsg">Passwords do not match</span>
		<!-- TO FORM 2 -->
		<input id="reg-next-acct" type="button" name="next" class="next action-button margin-auto" value="Next"/>
	</fieldset>
	<fieldset id="reg-fs-two" class="modal-ds-form">
    <div class="msform-close">
      <span class="modal-ds-close pointer">X</span>
    </div>
		<h4 class="fs-title">Personal Details</h2>
		<h4 class="fs-subtitle">Tell us about yourself.</h3>
		<!-- USER NAME -->
		<input v-model="regnewname" id="reg-new-fullname" class="register-input" type="text" name="fullname" placeholder="Full name" />
		<span id="reg-new-fullname-err" class="text-left ds-form-errmsg">Please enter your full name</span>
		<!-- USER PHONE NUMBERS -->
    <div class="flex-row-between">
  		<input v-model="regnewcell" id="reg-new-phone" class="register-input phone-format numbers-only" type="text" name="cellphone" style="margin-right: 10px" placeholder="Cell phone"/>
  		<input v-model="regnewhome" id="reg-new-home" class="register-input phone-format numbers-only" type="text" name="homephone" />
    </div>
		<div id="new-phone-helper" class="helper-modal hidden">
			<p>10 digit phone number<br/>We require at least one</p>
		</div>
		<span id="reg-new-phone-err" class="text-left ds-form-errmsg"></span>
		<!-- USER ADDRESS -->
    <textarea v-model="regnewstreet" id="reg-new-street" class="register-input" name="address" placeholder="Street address"></textarea>
		<span id="reg-new-street-err" class="text-left ds-form-errmsg">Please enter your street address</span>
		<!-- USER ZIP CODE -->
    <input v-model="regnewzip" id="reg-new-zip" class="register-input zip-autofeed numbers-only" type="text" name="zip" placeholder="Zip"/>
		<span id="reg-zip-autofill" class="register-zf">Denver, Colorado</span>
		<span id="reg-new-zip-err" class="text-left ds-form-errmsg">Please enter a valid zip code</span>
		<!-- TO FORM 3 -->
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input id="reg-next-det" type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset id="reg-fs-three" class="modal-ds-form">
    <div class="msform-close">
      <span class="modal-ds-close pointer">X</span>
    </div>
		<h4 class="fs-title">Traveler Details</h2>
		<h4 class="fs-subtitle">Who will be traveling with us?</h3>
		<!-- NEW TRAVELER(S) -->
		<traveler-modal :traveler="regtraveler" @remove="deleteTraveler(index)" v-for="(regtraveler, index) in regtravelers" v-bind:key="regtraveler.row" :id="index"></traveler-modal>
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
		<input id="reg-submit" type="submit" name="submit" class="submit action-button" value="Submit" @click="displayData"/>
	</fieldset>
</form>

<template id="traveler-modal-template">
	@include('partials.user.traveler_info')
</template>

<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
<script>
var TravelerModal = {
	template: "#traveler-modal-template",
	props : ['id', 'traveler'],
	data: function() {
		return {
			// name: "",
			// gender: "",
			// relate: "",
			// emerg: "",
			// ephn: "",
			genderIn: ['Male', 'Female', 'Other'],
			relateIn: ['Myself', 'Family', 'Spouse', 'Other']
		};
	},
	methods: {
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
			regnewemail: "jvannatta88@gmail.com",
			regnewpass: "Quasar88",
			regconfpass: "Quasar88",
			regnewname: "Josh Van Natta",
			regnewcell: "(720) 412-2575",
			regnewhome: "",
			regnewstreet: "1350 Grant St",
			regnewzip: "80202",
			regtravelers: [
				{name: "", gender: "", relate: "", emerg: "", ephn: ""}
			]
		},
		methods: {
			insertTraveler(){
				this.regtravelers.push({name: "", gender: "", relate: "", emerg: "", ephn: ""});
				$('.traveler-modal-container').addClass('active');
				bindTravelerModal($('.traveler-modal-title'));
			},
			updateTravelers(newObj, pos) {
					this.regtravelers[pos] = newObj;
			},
			deleteTraveler(index){
				Vue.delete(this.regtravelers, index);
			},
			displayData() {
				console.log(this.$data);
			}
		},
		mounted() {

		},
		components: {
			'traveler-modal' : TravelerModal
		}
});
</script>

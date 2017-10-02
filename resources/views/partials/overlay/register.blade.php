<!-- multistep form -->
<form id="msform" class="hidden" @keyup="canSubmit">
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
		<input v-model="reguser.email" @keyup="verifyEmail" @change="verifyEmail" id="reg-new-email" v-bind:class="{'input-add-errparent' : emailExists, 'register-input' : true}" type="text" name="email" placeholder="Email"/>
		<div class="input-add-err" v-if="emailExists == true">
			<input class="ds-form-error ds-details-err" readonly type="text" value="It looks like you already signed up. Please login">
				<img src="/assets/images/icons/hazard_tri.png" class="input-hazard"/>
			</input>
		</div>
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
		<input id="reg-next-acct" type="button" name="next" class="next action-button margin-auto" @click="formTwo" value="Next"/>
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
  		<input v-model="reguser.home" id="reg-new-home" class="register-input phone-format numbers-only" type="text" name="homephone" placeholder="Home phone"/>
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
		<span id="reg-zip-autofill" class="register-zf"></span>
		<span id="reg-new-zip-err" class="text-left ds-form-errmsg">Please enter a valid zip code</span>
		<!-- TO FORM 3 -->
		<input id="prevReg2" type="button" name="previous" class="previous action-button" value="Previous" />
		<input id="reg-next-det" @click="formThree" type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset id="reg-fs-three" class="modal-ds-form">
    <div class="msform-close">
      <span class="modal-ds-close pointer"  @click="clearData">X</span>
    </div>
		<h4 class="fs-title">Traveler Details</h2>
		<h4 class="fs-subtitle">Who will be traveling with us?</h3>
		<!-- NEW TRAVELER(S) -->
		<traveler-modal ref="traveler" :traveler="regtraveler" :submit="submitAttempt" @error="regIncomplete=true" @remove="deleteTraveler(index)" v-for="(regtraveler, index) in regtravelers" v-bind:key="regtraveler.row" :id="index"></traveler-modal>
		<div class="pointer flex-row-between traveler-modal-add" @click="insertTraveler">
      <span>Add traveler</span>
      <div class="flex-arrow">
        <div></div>
        <div></div>
      </div>
    </div>
		<a href="javascript:;" id="reg-no-travelers" class="free-link" @click="clearTravelers">Not sure yet? Click here to add travelers later</a>
		<!-- SUBMIT -->
		<input id="prevReg3" type="button" name="previous" class="previous action-button" value="Previous" />
		<button id="reg-submit" type="button" name="submit" :disabled="regIncomplete" v-bind:class="{'button-locked' : regIncomplete, 'submit action-button' : true}" value="Submit" @click="sendData">
			<img src="/assets/images/icons/locked-padlock.png" v-if="regIncomplete"/>Submit
		</button>
	</fieldset>
		<!-- Registering User -->
		<loading-modal :id="'register-loader'">
			<template slot="header">Please wait...</template>
			<template slot="message">We're creating your account now</template>
		</loading-modal>
		<!-- User successfully registered -->
		<success-modal :id="'register-success'" :button="'My account'" :href="reguser.email" :sub="false" :subxs="false">
			<template slot="header">Account created!</template>
			<template slot="message">Thanks for registering with Dragaud Sojourns. Visit your account to book a new trip or close this box to continue browsing.</template>
		</success-modal>
</form>
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>

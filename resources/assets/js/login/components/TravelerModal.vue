<template id="traveler-modal-template">
  <div id="traveler-modal-app" v-bind:class="{'traveler-warning' : hasWarning}">
    <div :id="'traveler-modal'+ id" class="traveler-modal-container shadow-close" @click="formatPhone">
      <div class="traveler-modal-title pointer flex-row-between">
        <span @click="expandMe">Traveler {{ id + 1 }}: {{ traveler.name }}</span>
        <div  :id="'traveler-modal'+ id + '-arrow'" class="flex-arrow flex-arrow-minus" @click="expandMe">
          <div></div>
          <div></div>
        </div>
      </div>
      <div :id="'traveler-modal'+ id + '-details'" class="traveler-modal-details flex-column-center">
        <input :id="'reg-trav' + id + '-fullname'" v-model="traveler.name" @click="showHelper" @blur="hideHelper" @keyup="testError({elem: 'reg-trav' + id + '-fullname', type: 'string'})" class="traveler-fullname traveler-input register-input" type="text" name="travelername" placeholder="Legal name"/>
        <span :id="'reg-trav' + id + '-fullname-err'" class="text-left ds-form-errmsg">Please enter travelers legal name</span>
        <div :id="'trav-' + id + '-helper'" class="helper-modal hidden">
    			<p>Legal name as it appears<br/>on travelers government issued ID</p>
    		</div>
        <input :id="'reg-trav' + id + '-dob'" v-model="traveler.dob" @keyup="testError({elem: 'reg-trav' + id + '-dob', type: 'date'})" @click="formatDate" class="traveler-dob traveler-input register-input numbers-only fulldate-format" type="text" name="travelerdob" placeholder="Date of birth"/>
        <span :id="'reg-trav' + id + '-dob-err'" class="text-left ds-form-errmsg">Enter a valid date: MM/DD/YYYY </span>
        <div class="flex-row-start">
          <div style="width: 50%; margin-right: 5px;">
            <select  :id="'reg-trav' + id + '-gender'" @click="testError({elem: 'reg-trav' + id + '-gender', type: 'select'})" v-model="traveler.gender" class="traveler-gender register-input traveler-select pointer" name="travgender">
              <option value="" hidden class="default-option">Gender</option>
              <option v-for="input in genderIn" :value="input" > {{ input }} </option>
            </select>
            <span :id="'reg-trav' + id + '-gender-err'" class="text-left ds-form-errmsg">Please select travelers gender</span>
          </div>
          <div style="width: 50%; margin-left: 5px;">
            <select :id="'reg-trav' + id + '-relate'" @click="testError({elem: 'reg-trav' + id + '-relate', type: 'select'})" v-model="traveler.relate" class="traveler-relation register-input traveler-select pointer" name="travrelationship">
              <option value="" hidden class="default-option">Relationship</option>
              <option v-for="input in relateIn" :value="input" > {{ input }} </option>
            </select>
            <span :id="'reg-trav' + id + '-relate-err'" class="text-left ds-form-errmsg">Please select your relationship</span>
          </div>
        </div>
        <h5>Emergency contact</h5>
        <input :id="'reg-trav' + id + '-emerg'" @keyup="testError({elem: 'reg-trav' + id + '-emerg', type: 'string'})"  v-model="traveler.emerg" class="travemerg-fullname traveler-input register-input" type="text" name="travelercont" placeholder="Full name">
        <span :id="'reg-trav' + id + '-emerg-err'" class="text-left ds-form-errmsg">Please enter an emergency contact</span>
        <input :id="'reg-trav' + id + '-ephn'" @keyup="testError({elem: 'reg-trav' + id + '-ephn', type: 'phone'})"  v-model="traveler.ephn" class="travemerg-phone traveler-input register-input phone-format numbers-only" type="text" @click="formatPhone" name="travelercontphone" placeholder="Phone">
        <span :id="'reg-trav' + id + '-ephn-err'" class="text-left ds-form-errmsg">Please enter a correct phone number</span>
        <a href="javascript:;" id="reg-no-travelers" class="free-link" @click="removeMe">Remove this traveler</a>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  	template: "#traveler-modal-template",
  	props : ['id', 'traveler', 'submit'],
  	data() {
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
        let el='#traveler-modal'+ this.id;
        if ($(el).hasClass('active')) {
          $(el).css('max-height', 'initial');
          setTimeout(function() {
            $(el).css('max-height', $(el).outerHeight());
          }, 100)
        }
  			if (this.submit == true) this.hasSubmit = true;
  				if (this.hasSubmit == true) {
  					let checkValid = validator.isValid([obj]);
  					if (checkValid != true) {
  							if (!this.warnings.includes(obj.elem))
  								this.warnings.push(obj.elem);
  					} else {
  							Vue.delete(this.warnings, this.warnings.indexOf(obj.elem));
  					}
  					if (this.warnings.length > 0) {
              this.hasWarning = true;
              this.$emit('error');
            } else {
              this.hasWarning = false ;
            }
  				}
  		},
  		expand(event) {
  			bindTravelerModal($(event.target));
  		},
  		expandMe(event) {
  			bindTravelerModal($(event.target).parent());
  		},
      showHelper(event){
        if ($(event.target).val() == ""){
          let el = "#trav-" + this.id + "-helper";
          slideLeft(el);
        }
      },
      hideHelper(){
        let el = "#trav-" + this.id + "-helper";
        fadeOut(el);
      },
      removeMe(){
        this.closeMe();
        let travMod = this;
        setTimeout(function() {
          travMod.$emit('remove');
        }, 400);
      },
      closeMe(){
        let el = '#traveler-modal'+ this.id + '-details';
        let elP = '#traveler-modal'+ this.id + '-arrow';
        $(elP).removeClass('flex-arrow-minus');
        bindTravelerModal($(el));
      },
  		formatPhone() {
  			$('.phone-format').mask('(000)000-0000');
  		},
      formatDate() {
  			$('.fulldate-format').mask('00/00/0000');
  		}
  	},
    mounted(){
      let el = '#traveler-modal'+ this.id + '-details';
      let elP = '#traveler-modal'+ this.id + '-arrow'
      $(el).css('bottom', $(el).outerHeight() + 30);
      bindTravelerModal($(el));
      $(elP).addClass('flex-arrow-minus');
    }
  }


</script>

<style>

</style>

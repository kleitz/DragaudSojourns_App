<template id="traveler-modal-template">
  <div id="traveler-modal-app">
    <div :id="'traveler-modal'+ id" class="traveler-modal-container profile-traveler-modal shadow-mix">
      <div class="traveler-modal-title pointer flex-row-between waves-effect waves-light">
        <span @click="expandMe" class="dot-dot-dot">{{ ( traveler.name == "") ? 'Traveler ' + (id + 1)  + ': ': '' }}{{ traveler.name }}</span>
        <div :id="'traveler-modal'+ id + '-arrow'" class="flex-arrow" @click="expandMe">
          <div></div>
          <div></div>
        </div>
      </div>
      <div :id="'traveler-modal'+ id + '-details'" class="traveler-modal-details flex-column-center" @click="formatTrav" >
        <form class="">
          <div class="material-form-group flex-row-start">
            <label for="travname">Name</label>
            <div>
              <input :id="'traveler-modal'+ id + '-name'" v-model="traveler.name" @keyup="testError({elem: 'traveler-modal' + id + '-name', type: 'string'})" class="inline-material-input" type="text" name="travname"/>
              <span :id="'traveler-modal'+ id + '-name-err'" class="text-left ds-form-errmsg">Please enter their legal name</span>
            </div>
          </div>
          <div class="material-form-group flex-row-start">
            <label for="travgender">Gender</label>
            <div>
              <select :id="'traveler-modal'+ id + '-gender'" @click="testError({elem: 'traveler-modal' + id + '-gender', type: 'select'})" v-model="traveler.gender" class="inline-material-input custom-select pointer" name="travgender">
                <option value="" hidden class="default-option">Gender</option>
                <option v-for="input in genderIn" :value="input" > {{ input }} </option>
              </select>
              <span :id="'traveler-modal'+ id + '-gender-err'" class="text-left ds-form-errmsg">Select their gender</span>
            </div>
          </div>
          <div class="material-form-group flex-row-start">
            <label for="travrelation">Relationship</label>
            <div>
              <select :id="'traveler-modal'+ id + '-relate'" @click="testError({elem: 'traveler-modal' + id + '-relate', type: 'select'})" v-model="traveler.relationship" class="inline-material-input custom-select  pointer" name="travrelationship">
                <option value="" hidden class="default-option">Relationship</option>
                <option v-for="input in relateIn" :value="input" > {{ input }} </option>
              </select>
              <span :id="'traveler-modal'+ id + '-relate-err'" class="text-left ds-form-errmsg">Select your relationship</span>
            </div>
          </div>
          <h6>Emergency contact</h6>
          <div class="material-form-group flex-row-start">
            <label for="travcontact">Name</label>
            <div>
              <input :id="'traveler-modal'+ id + '-emerg'" @keyup="testError({elem: 'traveler-modal' + id + '-emerg', type: 'string'})"  v-model="traveler.emerg_name" class="inline-material-input" type="text" name="travcontact">
              <span :id="'traveler-modal'+ id + '-emerg-err'" class="text-left ds-form-errmsg">Please enter a name</span>
            </div>
          </div>
          <div class="material-form-group flex-row-start">
            <label for="travcontphone">Phone</label>
            <div>
              <input :id="'traveler-modal'+ id + '-ephn'" @keyup="testError({elem: 'traveler-modal' + id + '-ephn', type: 'phone'})"  v-model="traveler.emerg_phone" class="inline-material-input phone-format numbers-only" type="text" @click="formatTrav" name="travcontphone">
              <span :id="'traveler-modal'+ id + '-ephn-err'" class="text-left ds-form-errmsg">Please enter a valid number</span>
            </div>
          </div>
        </form>
        <div class="flex-row-between" v-if="traveler.created_at != '' ">
          <a href="javascript:;" class="free-link"  @click="saveChanges">Save changes</a>
          <a href="javascript:;" class="free-link"  @click="undoChanges">Undo changes</a>
        </div>
        <div class="flex-row-between" v-if="traveler.created_at == '' ">
          <a href="javascript:;" class="free-link" @click="storeNew">Save traveler</a>
          <a href="javascript:;" class="free-link"  @click="removeMe">Cancel</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  	template: "#traveler-modal-template",
  	props : ['id', 'traveler'],
  	data() {
  		return {
        hasSubmit: false,
  			travErr: [{elem: 'traveler-modal' + this.id + '-name', type: 'string'},
                  {elem: 'traveler-modal' + this.id + '-gender', type: 'select'},
                  {elem: 'traveler-modal' + this.id + '-relate', type: 'select'},
                  {elem: 'traveler-modal' + this.id + '-emerg', type: 'string'},
                  {elem: 'traveler-modal' + this.id + '-ephn', type: 'phone'}
        ],
  			genderIn: ['Male', 'Female', 'Other'],
  			relateIn: ['Myself', 'Family', 'Spouse', 'Other']
  		};
  	},
  	methods: {
  		testError(obj) {
  				if (this.hasSubmit == true) {
  					validator.isValid([obj]);
  				}
  		},
  		expand(event) {
        acctTravelerModal($(event.target));
  		},
  		expandMe(event) {
        acctTravelerModal($(event.target).parent());
  		},
      removeMe(){
        this.closeMe();
        this.$emit('remove');
      },
      closeMe(){
        let el = '#traveler-modal'+ this.id + '-details';
        let elP = '#traveler-modal'+ this.id + '-arrow';
        $(elP).removeClass('flex-arrow-minus');
        acctTravelerModal($(el));
      },
      saveChanges() {
        let travApp = this;
        let checkValid = validator.isValid(this.travErr);
        this.hasSubmit = true;
        let el='#traveler-modal'+ this.id;
        $(el).css('max-height', '-webkit-fill-available');
        setTimeout(function(){
          $(el).css('max-height', $(el).outerHeight());
        }, 100);
        if (checkValid == true) {
          $.ajax({
            type: "POST",
            url: '/updatetraveler',
            data: { traveler : travApp.traveler},
            success: function(response){
              window.location.reload();
            }
          });
        }
      },
      undoChanges() {
        window.location.reload();
      },
      storeNew() {
        let checkValid = validator.isValid(this.travErr);
        this.hasSubmit = true;
        let el='#traveler-modal'+ this.id;
        $(el).css('max-height', '-webkit-fill-available');
        setTimeout(function(){
          $(el).css('max-height', $(el).outerHeight());
        }, 100);
        if (checkValid == true) {
          let travData = [{
            name: this.traveler.name,
            emerg: this.traveler.emerg_name,
            ephn: this.traveler.emerg_phone,
            relate: this.traveler.relationship,
            gender: this.traveler.gender
          }];
          let curUser = this.traveler.user;
          $.ajax({
            type: "POST",
            url: '/newtraveler',
            data: { travelers : travData, user : curUser, len : 1 },
            success: function(response){
              window.location.reload();
            }
          });
        }
      },
  		formatTrav() {
  			$('.phone-format').mask('(000)000-0000');
  		}
  	},
    mounted()  {
      let el = '#traveler-modal'+ this.id + '-details';
      let elP = '#traveler-modal'+ this.id + '-arrow'
      $(el).css('bottom', $(el).outerHeight() + 30);
      if (this.traveler.created_at == "") {
        acctTravelerModal($(el));
        $(elP).addClass('flex-arrow-minus');
      }
    },
  }


</script>

<style>

</style>

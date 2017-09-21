<div id="traveler-modal-app">
  <div class="traveler-modal-container shadow-close active" >
    <div class="traveler-modal-title pointer flex-row-between" @click="expand">
      <span @click="expandMe">Traveler @{{ id + 1 }}: @{{ traveler.name }}</span>
      <div class="flex-arrow flex-arrow-minus" @click="expandMe">
        <div></div>
        <div></div>
      </div>
    </div>
    <div class="traveler-modal-details flex-column-center">
      <input v-model="traveler.name" class="traveler-fullname traveler-input register-input" type="text" name="travelername" placeholder="Full name"/>
      <span class="text-left ds-form-errmsg">Please enter your full name</span>
      <select v-model="traveler.gender" class="traveler-gender register-input traveler-select pointer" name="travgender">
        <option value="" hidden>Gender</option>
        <option v-for="input in genderIn" :value="input" > @{{ input }} </option>
      </select>
      <select v-model="traveler.relate" class="traveler-relation register-input traveler-select pointer" name="travrelationship">
        <option value="" hidden>Relationship</option>
        <option v-for="input in relateIn" :value="input" > @{{ input }} </option>
      </select>
      <h5>Emergency contact</h5>
      <input v-model="traveler.emerg" class="travemerg-fullname traveler-input register-input" type="text" name="travelercont" placeholder="Full name">
      <input v-model="traveler.ephn" class="travemerg-phone traveler-input register-input phone-format numbers-only" type="text" @click="formatPhone" name="travelercontphone" placeholder="Phone">
      <a href="javascript:;" id="reg-no-travelers" class="free-link" @click="$emit('remove')">Remove this traveler</a>
    </div>
  </div>
</div>

<div class="col-xs-3">
  <div id="profile-details" class="expander shadow-far">
    <div class="expander-header panel-heading border-panel floating-div">
      <h5 class="font-light profile-details-header">{{ auth()->user()->name }}</h5>
      <div class="flex-row-between">
        <a id="profile-expand" href="javascript:;" @click="userDetailsExpand">Edit your profile</a>
        <a href="javascript:;" @click="userDetailsClear" v-if="userExpand == true">Cancel</a>
      </div>
    </div>
    <div class="expander-content beveled-div">
      <div class="beveled-input {{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="control-label">E-Mail Address
          <img src="/assets/images/icons/hazard_tri.png" id="usr-email-err" class="inline-hazard"/>
          <img src="/assets/images/icons/success_check.png" class="inline-success profile-success opaque"/>
        </label>
        <input @click="hideErrEmail" @keyup="validate(userErr.email)" id="usr-email" v-model="userDetails.email" type="email" class="form-control" name="email" required>
        <div id="err-email-helper" class="helper-modal hidden helper-err">
    			<p>Error: not available</p><img src="/assets/images/icons/hazard_tri.png" class="inline-hazard visible"/>
          <p>This email address is already taken</p>
    		</div>
      </div>
      <div class="beveled-input {{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="street" class="control-label">Address
          <img src="/assets/images/icons/hazard_tri.png" id="usr-street-err" class="inline-hazard"/>
          <img src="/assets/images/icons/success_check.png" class="inline-success profile-success opaque"/>
        </label>
        <input @keyup="validate(userErr.street)" id="usr-street" v-model="userDetails.street" type="text" class="form-control" name="street" required>
      </div>
      <div class="beveled-input {{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="zip" class="control-label">ZIP
          <img src="/assets/images/icons/hazard_tri.png" id="usr-zip-err" class="inline-hazard"/>
          <img src="/assets/images/icons/success_check.png" class="inline-success profile-success opaque"/>
        </label>
        <div class="zip-bundle">
          <input @keyup="validate(userErr.zip)" id="usr-zip" v-model="userDetails.zip" type="text" class="form-control numbers-only zip-format" name="zip"required>
          <div class="zip-autofill"></div>
        </div>
      </div>
      <div class="beveled-input {{ $errors->has('email') ? ' has-error' : '' }}">
        <div class="row">
          <div class="col-xs-6">
            <label for="cell" class="control-label">Cell
              <img src="/assets/images/icons/hazard_tri.png" id="usr-cell-err" class="inline-hazard"/>
              <img src="/assets/images/icons/success_check.png" class="inline-success profile-success opaque"/>
            </label>
            <input @keyup="validate(userErr.cell)" id="usr-cell" v-model="userDetails.cell" type="text" class="form-control phone-format" name="cell" required>
          </div>
          <div class="col-xs-6">
            <label for="home" class="control-label">Home
              <img src="/assets/images/icons/hazard_tri.png" id="usr-home-err" class="inline-hazard"/>
              <img src="/assets/images/icons/success_check.png" class="inline-success profile-success opaque"/>
            </label>
            <input @keyup="validate(userErr.home)" id="usr-home" v-model="userDetails.home" type="text" class="form-control phone-format" name="home" required>
          </div>
        </div>
      </div>
      <div class="beveled-input flex-col-end {{ $errors->has('email') ? ' has-error' : '' }}">
        <a href="javascript:;">Change your password...</a>
      </div>
    </div>
  </div>
  <div id="traveler-details" class="panel-heading border-panel grey-panel profile-traveler">
    <h5 class="font-light profile-details-header">My Travelers</h5>
    <div class="profile-traveler-container" style="margin-top: 15px">
      <traveler-modal  v-for="(userTraveler, index) in userTravelers" ref="traveler" :traveler="userTraveler" @error="alert" @remove="removeNewTraveler" v-bind:key="userTraveler.row" :id="index"></traveler-modal>
  		<div class="pointer flex-row-between traveler-modal-add" @click="emptyTraveler">
        <span>Add traveler</span>
        <div class="flex-arrow">
          <div></div>
          <div></div>
        </div>
      </div>
    </div>
  </div>
</div>

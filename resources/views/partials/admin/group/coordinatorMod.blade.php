<div class="abs-fill hidden" id="new-coordinator-modal" style="z-index: 500">
  <div class="flex-abs-center full-height">

    <div  class="panel panel-secure full-width payment-modal absolute" style="max-width: 400px">
      <div class="panel-heading flex-row-between">
        <h2 class="panel-title flex-col-center">New coordinator</h2>
        <span class="modal-ds-close pointer" @click="closeModals">X</span>
      </div>
      <div class="panel-body grey-panel">

        <!-- METHOD SELECT -->
        <div class="payment-type" style="margin-bottom: 15px">
          <label class="custom-control custom-radio">
            <input checked="false" id="radio-new-user" name="radio" type="radio" class="custom-control-input" @click="storeMethod">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description" style="font-size: 18px; font-weight: 300">Create new</span>
          </label>
          <label class="custom-control custom-radio" style="margin-left: 15px">
            <input checked="true" id="radio-existing-user" name="radio" type="radio" class="custom-control-input" @click="storeMethod">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description" style="font-size: 18px; font-weight: 300">Select existing</span>
          </label>
        </div>

        <!-- ADD NEW -->
        <div v-if="coordinator.new.active == 1" class="panel panel-secure-inner border-panel-light modal-popup-form">
          <form action="/coordinators/create" method="GET" enctype="multipart/form-data" @keyup="preventEnter" @keypress="preventEnter">
            <!-- New user name -->
            <div class="form-group">
              <label for="newuser-name">Full name</label>
              <div class="flex-row-start">
                <input type="text" class="form-control" name="user_name" v-model="coordinator.new.name" @keyup='validateNewUser' @blur='validateNewUser' @change='validateNewUser'>
              </div>
            </div>
            <!-- New user email -->
            <div :class="{ 'has-error' : coordinator.new.available == false, 'form-group' : true }" style="margin-bottom: 40px">
              <label for="newuser-name">Email address</label>
              <input type="text" class="form-control" name="user_email" v-model="coordinator.new.email" @keyup='checkNewUser' @blur='validateNewUser' @change='validateNewUser'>
              <small :class="{'hidden' : coordinator.new.available != false, 'ds-errmsg-gen' : true}">This user already exists</small>
            </div>
            <!-- New user phone numbers -->
            <div class="flex-row-start">
              <div class="form-group" style="margin-right: 10px; width: 50%">
                <label for="newuser-name">Home phone</label>
                <input type="text" class="form-control phone-format" name="user_home" v-model="coordinator.new.home" @keyup='validateNewUser' @blur='validateNewUser' @change='validateNewUser'>
              </div>
              <div class="form-group" style="margin-left: 10px; width: 50%">
                <label for="newuser-name">Cell phone</label>
                <input type="text" class="form-control phone-format" name="user_cell" v-model="coordinator.new.cell" @keyup='validateNewUser' @blur='validateNewUser' @change='validateNewUser'>
              </div>
            </div>
            <!-- New user phone numbers -->
            <div class="flex-row-start" style="margin-bottom: 40px">
              <div class="form-group" style=" width: 75%">
                <label for="newuser-name">Address</label>
                <input type="text" class="form-control" name="user_street" v-model="coordinator.new.street" @keyup='validateNewUser' @blur='validateNewUser' @change='validateNewUser'>
              </div>
              <div class="form-group" style="margin-left: 10px; width: 25%">
                <label for="newuser-name">Zip</label>
                <input type="text" maxlength="5" class="form-control numbers-only" name="user_zip" v-model="coordinator.new.zip" @keyup='validateNewUser' @blur='validateNewUser' @change='validateNewUser'>
              </div>
            </div>
            <!-- Hidden fields to send to controller -->
            <input type="hidden" name="group_id" :value="group.id">
            <input type="hidden" name="group_number" :value="group.number">

            <button type="submit" style="height: 50px" v-bind:class="{'button-locked' : coordinator.valid != true, 'ds-button full-width button-gen waves-effect waves-light' : true}">
              <img v-if="coordinator.valid != true" src="/assets/images/icons/locked-padlock.png" />Add coordinator</button>
          </form>
        </div>

        <!-- ADD EXISTING -->
        <div v-if="coordinator.existing.active == 1" class="panel panel-secure-inner border-panel-light modal-popup-form">
          <!-- Search by name -->
          <div class="form-group">
            <label for="searchuser">Search by name</label>
            <div class="flex-row-start">
              <input type="text" class="form-control" name="searchuser" v-model="searchUser" @keyup="searchAuto">
              <a href="javascript:;" class="gfocus-button ds-button button-cancel auto-width" style="margin-left: 5px" @click="searchExisting">Search</a>
            </div>
          </div>
          <!-- Results of seach -->
          <form action="/coordinators/store" method="GET" enctype="multipart/form-data" @keyup="preventEnter" @keypress="preventEnter">
            <div class="form-group">
              <label for="selectuser">Select user</label>
              <select @change="updateSelected" v-model="coordinator.existing.selected" class="custom-select form-control" name="selectuser" size="4">
                <option v-if="selectUser.length == 0 && coordinator.existing.searched == false" value="null" style="color: #aaa" disabled>Search results will appear here</option>
                <option v-if="selectUser.length == 0 && coordinator.existing.searched == true" value="null" style="color: #aaa" disabled>Your search returned 0 users</option>
                <option v-for="user, index in selectUser" :value="index" > @{{ user.name }} (@{{ user.email }})</option>
              </select>
            </div>
            <!-- If selected user is existing coordinator -->
  					<div v-if="coordinator.valid == false" class="alert alert-danger" style="padding: 12px; margin-bottom: 15px">
  							<ul>
  									<li>
                      <div class="flex-row-start">
                        <img src="/assets/images/icons/hazard_tri.png" alt="" class="clear-img flex-self-centered" width="18px" height="18px">
    									  <div style="font-size: 16px; margin-left: 5px">This user is already a coordinator for @{{ group.number }}!<div>
    									</div>
                  </li>
  							</ul>
  					</div>
            <!-- Selected user confirm -->
            <div class="form-group" style="margin-bottom: 50px">
              <label for="selectuser">Selected</label>
              <input type="text" class="form-control" :value="coordinator.existing.name" readonly>
            </div>
            <!-- Hidden fields to send to controller -->
            <input type="hidden" name="user_id" :value="coordinator.existing.id">
            <input type="hidden" name="group_id" :value="group.id">
            <input type="hidden" name="group_number" :value="group.number">

            <button type="submit" style="height: 50px" v-bind:class="{'button-locked' : coordinator.valid != true, 'ds-button full-width button-gen waves-effect waves-light' : true}">
              <img v-if="coordinator.valid != true" src="/assets/images/icons/locked-padlock.png" />Add coordinator</button>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="abs-fill hidden" id="remove-coordinator-modal" style="z-index: 500">
  <div class="flex-abs-center full-height">

    <div  class="panel panel-secure full-width flex-col-center absolute" style="max-width: 380px; height: 200px">
        <div style="margin: 0 30px">
          <p class="text-center">
            Remove <span style="font-weight: 500; margin: 0 2px; font-style: italic">@{{ removeIndex.user.name }}</span> from the list of coordinators for group @{{ group.number }}?
          </p>
          <div class="flex-row-center" style="margin-top: 15px">
            <button @click="deleteSelected" type="button" class="ds-button button-gen waves-effect waves-light" style="margin-right: 15px">Confirm</button>
            <button @click="closeModals" type="button" class="ds-button button-gen waves-effect waves-light button-cancel">Cancel</button>
          </div>
        </div>
    </div>

  </div>
</div>

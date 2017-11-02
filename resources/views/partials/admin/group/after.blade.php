<form @mouseenter="updateData" @click="updateData" class="" action="/groups/{{$group->id}}/{{$authAdmin}}/update" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="destination">Destination</label>
    <input @keyup="updateData" v-model="groupOut.destination" type="text" name="destination" class="form-control" id="group-destination">
  </div>
  <div class="row gc-date">
    <div class="form-group col-xs-6">
      <label for="depart">Departure Date</label>
      <input v-model="groupOut.depart" type="text" name="depart" class="form-control" id="group-depart" >
    </div>
    <div class="form-group col-xs-6">
      <label for="return">Return Date</label>
      <input v-model="groupOut.return" type="text" name="return" class="form-control" id="group-return" >
    </div>
  </div>
  <div class="form-group">
    <label for="school">School</label>
    <input @keyup="updateData" v-model="groupOut.school" type="text" name="school" class="form-control" id="group-school" >
  </div>
  <!-- GROUP PACKAGES-->
  <div class="form-group">
    <label for="packages" >Packages</label>
      <div class="packages-contain">
        <table class="packages-table">
          <tr v-for="package, index in groupPackages">
            <td width="45%" style="padding-right: 0px">
              <input @keyup="updateData" v-model="groupPackages[index].name" type="text" class="form-control" placeholder="Package" :value="package.name" >
              <span class="packages-dolla" style="top: 10px">$</span>
            </td>
            <td width="45%">
              <input @keyup="updateData" style="padding-left: 22px" type="text" @blur="formatCurrency(index, $event)" class="form-control floats-only currency-format" :value="package.cost">
           </td>
            <td width="10%">
              <button v-if="index != 0" @click="removePackage(index)" type="button" name="button"class="gc-button" style="min-width: auto">X</button>
            </td>
          </tr>
        </table>
      </div>
      <div style="margin: 10px 0 0 ">
        <button @click="insertPackage" type="button" name="button" class="gc-button">Add package</button>
      </div>
    <input v-model="groupOut.packages" class="hidden" name="packages" :value="groupOut.packages">
  </div>
<!-- GROUP UPLOADS -->
  <div class="form-group relative">
    <label for="groupicon">Uploads</label>
<!-- GROUP ICON -->
      <div class="form-group">
       <div class="input-group relative">
           <label class="input-group-btn">
               <span class="btn flex-col-center gc-button" style="margin-right: 0" @click="showIconSelect">
                   Trip Icon&hellip; <input name="icon" style="display: none;" v-model="groupOut.icon" multiple>
               </span>
           </label>
           <input v-model="groupIcon" @change="updateData" type="text" class="form-control dot-dot-dot gc-file-input" style="background: white; border-left: 0px;" readonly>
           <span class="upload-placeholder dot-dot-dot" id="group-icon"></span>
           <div id="iconselect-mount"  class="absolute"></div>
       </div>
     </div>
<!-- GROUP ITINERARY -->
     <div class="form-group">
       <div class="input-group relative">
           <label class="input-group-btn">
               <span class="btn flex-col-center gc-button" style="margin-right: 0">
                   Itinerary&hellip; <input  @change="updateItinerary" type="file" name="itinerary" style="display: none;" multiple>
               </span>
           </label>
           <input type="text" class="form-control dot-dot-dot gc-file-input" style="background: white; border-left: 0px;" readonly>
           <span class="upload-placeholder dot-dot-dot" id="group-itinerary"></span>
       </div>
   </div>
<!-- GROUP RELEASE -->
     <div class="form-group">
       <div class="input-group relative">
           <label class="input-group-btn">
               <span class="btn flex-col-center gc-button" style="margin-right: 0">
                   Release&hellip; <input @change="updateRelease" type="file" name="release" style="display: none;" multiple>
               </span>
           </label>
           <input type="text" class="form-control dot-dot-dot gc-file-input" style="background: white; border-left: 0px;" readonly>
           <span class="upload-placeholder dot-dot-dot" id="group-release"></span>
       </div>
     </div>
</div>
  <div class="form-group">
    <label for="message">Message</label>
    <textarea @keyup="updateData" v-model="groupOut.message" class="form-control" name="message" rows="3" style="max-width: 100%"></textarea>
  </div>
  <button type="submit" name="submitdetails" :class="{'button-locked' : groupDetails == false, 'ds-button button-gen waves-effect waves-dark' : true}">
    <img v-if="groupDetails == false" src="/assets/images/icons/locked-padlock.png" />Save changes
  </button>
</form>

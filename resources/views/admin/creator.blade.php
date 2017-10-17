@extends('layouts.admin.master', [
	'title' => 'Create New Group | Dragaud Custom Sojourns',
])

@section('content')
    <div class="container admin-container">
      <div class="admin-floating-panel z-depth-2 col-xs-8" @click="updateDates">
        <h3 class="admin-section-header" >New group</h3>
        <form method="POST" action="/groups/store" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group form-inline inline-material-large" style="margin-bottom: 15px !important">
            <label for="number">Group Number</label>
            <input @click="updateDates"v-model="group.number" name="number" class="form-control numbers-only material-input" id="group-number" placeholder="">
          </div>
          <div class="form-group">
            <label for="destination">Destination</label>
            <input @click="updateDates"v-model="group.destination" type="text" name="destination" class="form-control" id="group-destination" placeholder="">
          </div>
          <div class="row">
            <div class="form-group col-xs-6">
              <label for="depart">Departure Date</label>
              <input type="text" name="depart" class="form-control" id="group-depart" placeholder="">
            </div>
            <div class="form-group col-xs-6">
              <label for="return">Return Date</label>
              <input type="text" name="return" class="form-control" id="group-return" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label for="school">School</label>
            <input @click="updateDates"v-model="group.school" type="text" name="school" class="form-control" id="group-school" placeholder="">
          </div>
          <div class="form-group">
            <label for="packages" style="margin-bottom: 15px">Packages</label>
						<div class="row" v-for="package, index in groupPackages">
							<div class="col-xs-5" >

								<div class="form-group row">
						      <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
						      <div class="col-sm-10">
						        <input v-model="groupPackages[index].name" type="text" class="form-control" placeholder="Email" :value="package.name">
						      </div>
						    </div>

							</div>
							<div class="col-xs-5">

								<div class="form-group row">
						      <label for="inputEmail3" class="col-sm-2 col-form-label">Cost</label>
						      <div class="col-sm-10">
						        <input v-model="groupPackages[index].cost" type="text" class="form-control" placeholder="Email" :value="package.cost">
						      </div>
						    </div>

							</div>
							<div class="col-xs-2">
								<button type="button" name="button" @click="removePackage(index)">Remove</button>
							</div>
						</div>
						<div class="">
							<button @click="insertPackage"  type="button" name="button">Add package</button>
						</div>
						<input v-model="group.packages" class="hidden" name="packages" :value="group.packages">
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Trip Icon</label>
            <input @click="updateDates" @change="updateIcon" type="file" name="icon" id="group-icon" class="form-control-file" aria-describedby="fileHelp">
          </div>
          <div class="form-group">
            <label for="itinerary">Itinerary</label>
            <input @click="updateDates" @change="updateItinerary" type="file" name="itinerary" id="group-itinerary"  class="form-control-file" aria-describedby="fileHelp">
          </div>
          <div class="form-group">
            <label for="release">Release</label>
            <input @click="updateDates"@change="updateRelease" type="file" name="release" id="group-release" class="form-control-file" aria-describedby="fileHelp">
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea @click="updateDates" v-model="group.message" class="form-control" name="message" id="exampleTextarea" rows="3"></textarea>
          </div>
					<button type="submit" name="submitdetails" :class="{'button-locked' : groupDetails == false, 'ds-button button-gen waves-effect waves-dark' : true}">
      			<img v-if="groupDetails == false" src="/assets/images/icons/locked-padlock.png" />Book now!
      		</button>
        </form>
      </div>
    </div>
    @endsection

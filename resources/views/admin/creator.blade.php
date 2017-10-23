@extends('layouts.admin.master', [
	'title' => 'Create New Group | Dragaud Custom Sojourns',
])

@section('content')
    <div id="group-create-app" class="container admin-container">
<!-- NEW GROUP FORM -->
		<div class="col-xs-7 relative" style="z-index: 20">
      <div class="admin-floating-panel z-depth-2">
        <h3 class="admin-section-header" >New group</h3>
        <form method="POST" action="/groups/store" enctype="multipart/form-data">
          {{ csrf_field() }}
	<!-- GROUP NUMBER -->
          <div :class="{'material-large-err' : groupExists == true, 'form-group form-inline inline-material-large flex-row-start' : true}" style="margin-bottom: 15px !important">
            <label for="number">Group Number</label>
						<div class="flex-col-start" style="margin-left: 5px">
							  <input v-model="group.number" @blur="groupPrecheck" @keyup="groupPrecheck" name="number" class="form-control numbers-only material-input" id="group-number" placeholder="">
								<small :class="{'hidden': groupExists == false}" style="font-size: 13px">This group already exists!</small>
						</div>
          </div>

	<!-- GROUP DESTINATION -->
          <div class="form-group">
            <label for="destination">Destination</label>
            <input v-model="group.destination" @keyup="updateDates" type="text" name="destination" class="form-control" id="group-destination" placeholder="">
          </div>

	<!-- GROUP DATES -->
          <div class="row gc-date">
            <div class="form-group col-xs-6">
              <label for="depart">Departure Date</label>
              <input type="text" name="depart" class="form-control" id="group-depart" placeholder="">
            </div>
            <div class="form-group col-xs-6">
              <label for="return">Return Date</label>
              <input type="text" name="return" class="form-control" id="group-return" placeholder="">
            </div>
          </div>

	<!-- GROUP SCHOOL -->
          <div class="form-group">
            <label for="school">School</label>
            <input v-model="group.school" @keyup="updateDates" type="text" name="school" class="form-control" id="group-school" placeholder="">
          </div>
	<!-- GROUP PACKAGES-->
          <div class="form-group">
            <label for="packages" >Packages</label>
						<div class="form-bundle">
							<div class="packages-contain">
								<table class="packages-table">
									<tr v-for="package, index in groupPackages">
										<td width="10%">
											Name
										</td>
					<!-- PACKAGE NAME -->
										<td width="30%">
											<input @keyup="updateDates" v-model="groupPackages[index].name" type="text" class="form-control" placeholder="Package" :value="package.name">
										</td>
										<td width="10%">
											Cost<span class="packages-dolla">$</span>
										</td>
				<!-- PACKAGE COST -->
										<td width="30%">
											<input style="padding-left: 22px" @keyup="updateDates" @blur="formatCurrency(index, $event)" type="text" class="form-control floats-only currency-format" :value="package.cost">
									 </td>
										<td width="20%">
											<button v-if="index != 0" type="button" name="button" @click="removePackage(index)" class="gc-button" style="min-width: auto">Remove</button>
										</td>
									</tr>
								</table>
							</div>
							<div style="margin: 10px 0 0 ">
								<button @click="insertPackage"  type="button" name="button" class="gc-button">Add package</button>
							</div>
						</div>
						<input v-model="group.packages" class="hidden" name="packages" :value="group.packages">
          </div>
		<!-- GROUP UPLOADS -->
					<div class="form-group relative">
						<label for="groupicon">Uploads</label>
						<div class="form-bundle" style="width: 70%">
			<!-- GROUP ICON -->
							<div class="form-group">
							 <div class="input-group">
									 <label class="input-group-btn">
											 <span class="btn flex-col-center gc-button" style="margin-right: 0" @click="showIconSelect">
													 Trip Icon&hellip; <input id="group-icon"  name="icon" style="display: none;" v-model="group.icon" multiple>
											 </span>
									 </label>
									 <input v-model="groupIcon" type="text" class="form-control dot-dot-dot gc-file-input" style="background: white; border-left: 0px;" readonly>
							 </div>
						 </div>
	 	<!-- GROUP ITINERARY -->
						 <div class="form-group">
							 <div class="input-group">
									 <label class="input-group-btn">
											 <span class="btn flex-col-center gc-button" style="margin-right: 0">
													 Itinerary&hellip; <input  @change="updateItinerary" type="file" name="itinerary" id="group-itinerary" style="display: none;" multiple>
											 </span>
									 </label>
									 <input type="text" class="form-control dot-dot-dot gc-file-input" style="background: white; border-left: 0px;" readonly>
							 </div>
					 </div>
	 	<!-- GROUP RELEASE -->
						 <div class="form-group">
							 <div class="input-group">
									 <label class="input-group-btn">
											 <span class="btn flex-col-center gc-button" style="margin-right: 0">
													 Release&hellip; <input  @change="updateRelease" type="file" name="release" id="group-release" style="display: none;" multiple>
											 </span>
									 </label>
									 <input type="text" class="form-control dot-dot-dot gc-file-input" style="background: white; border-left: 0px;" readonly>
							 </div>
						 </div>
					</div>
		<!-- ICON SELECT POPUP -->
					<div id="icon-select" class="absolute group-icon-select hidden">
						<div class="z-depth-1 panel panel-secure ">
							<div class="panel-heading grey-panel flex-row-between">
								<h2 class="panel-title flex-col-center">Icon Select</h2>
								<span class="modal-ds-close pointer" @click="hideIconSelect">X</span>
							</div>
							<div class="panel-body">
								<div :class="{'icon-delete-container' : deleteMode == 1, 'panel-scroll relative' : true}" style="height: 250px">
									<div v-if="iconLoading == true" class="abs-fill flex-abs-center">
										<svg class="spinner spinner-dark" width="60px" height="60px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
											<circle class="circle" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
										</svg>
									</div>
									<?php
										$iconList = [];
										$num = 0;
										foreach (glob("storage/icons/*") as $icon) {
											$iconList[$num] = $icon;
											$num++;
										}
								 ?>
									<div v-if="iconLoading == false" class="row flex-gen">
										<div v-for="icon, index in iconList" class='col-xs-4 flex-col'>
											<label class='group-icon full-height flex-col-end'>
												<div class='full-width relative'>
													<div class='icon-overlay abs-fill'></div>
													<img :src=" '/' + icon.loc" class='full-width'>
												</div>
												<div>
													<input @click='selectIcon(index, $event)' type='radio' name='icon.jpg' :value='icon.loc'>@{{ icon.name }}
												</div>
											</label>
										</div>
									</div>
								</div>
						<!-- UPLOAD NEW ICON -->
								<div style="margin-top: 20px" class="flex-row-between">
									<div class="input-group" style="width: 120px">
										<label class="input-group-btn">
												<span class="btn flex-col-center gc-button" style="margin-right: 0; ">
														Upload new&hellip; <input accept="image/*"  @change="uploadNewIcon" type="file" style="display: none;" multiple/>
												</span>
										</label>
									</div>
									<button @click="deleteToggle" type="button" :class="{'gc-delete-active' : deleteMode == 1, 'gc-button gc-delete' : true}" style="width: 120px">@{{ deleteMessage }}</button>
								</div>
							</div>
						</div>
					</div>

					</div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea @keyup="updateDates"  v-model="group.message" class="form-control" name="message" id="exampleTextarea" rows="3" style="max-width: 100%"></textarea>
          </div>
					<button type="submit" name="submitdetails" :class="{'button-locked' : groupDetails == false, 'ds-button button-gen waves-effect waves-dark' : true}">
      			<img v-if="groupDetails == false" src="/assets/images/icons/locked-padlock.png" />Book now!
      		</button>
        </form>
      </div>
		</div>
<!-- GROUP PREVIEW -->
		<div class="col-xs-5">
			<div class="admin-floating-panel z-depth-1 relative" style="top: 150px; padding: 35px">
				<h4 class="admin-section-subheader" style="margin-top: 10px">Preview: </h4>
				<div class="panel panel-secure border-panel-light">
					<div class="panel-heading grey-panel flex-row-between">
						<h5>
							<span v-if="group.number == ''" style="color: #ccc">1800: </span>
							<span v-if="group.number != ''" >@{{group.number}}: </span>
							<span v-if="group.destination == ''" style="color: #ccc">City, ST</span>
							 @{{(group.destination != '') ? group.destination : ''}}
						</h5>
						<h5><span>@{{'$' + examplePackage}}</span></h5>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-4" style="padding-right: 0px">
								<img :src="(group.icon != '') ? '/' + group.icon : '/assets/images/icons/default.jpg'" alt="" style="width: 100%; padding: 0; border: 1px solid #ddd; border-radius: 3px">
							</div>
							<div class="col-xs-8">
								<div class="col-xs-12" style="padding: 0">
									<p v-if="group.school == ''" style="color: #ccc">School name</p>
									<p v-if="group.school != ''" ><strong>@{{ group.school }}</strong></p>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<p style="margin-bottom: -2px">Departs:</p>
										<p style="margin-bottom: -2px">Returns:</p>
									</div>
									<div class="col-xs-6">
										<p v-if="group.depart == ''" style="margin-bottom: -2px; color: #ccc; font-weight: 300;">--/--/----</p>
										<p v-if="group.depart != ''" style="margin-bottom: -2px"><strong>@{{group.depart}}<strong></p>
										<p v-if="group.return == ''" style="margin-bottom: -2px; color: #ccc; font-weight: 300;">--/--/----</p>
										<p v-if="group.return != ''" style="margin-bottom: -2px"><strong>@{{group.return}}<strong></p>
									</div>
								</div>
							</div>
						</div>
						<hr style="border-color: #ddd"/>
						<div class="row">
							<div class="col-xs-4">
								<p>Packages:</p>
							</div>
							<div class="col-xs-8">
								<select style="font-size: 16px; font-weight: 400;" v-model="examplePackage" class="form-control" name="">
									<option v-for="package in groupPackages" :value="package.cost">@{{package.name}}: @{{'$' + package.cost}}</option>
								</select>
							</div>
						</div>
						<hr style="border-color: #ddd"/>
						<p style="margin: 0px;line-height: 1.4;font-size: 16px;"><strong>Note from Michael</strong></p>
						<p v-if="group.message == ''" style="margin: 0px;line-height: 1.4;font-size: 16px;color: #ccc;font-weight: 400">Lorem ipsum dolor sit amet, consectetur adipisicing elit....</p>
						<p v-if="group.message != ''" style="margin: 0px;line-height: 1.4;font-size: 16px;font-weight: 400;">@{{group.message}}</p>
					</div>
				</div>
			</div>
		</div>
  </div>
	<!-- SCRIPTS -->
	<script>
	// PHP VARIABLES -> JAVASCRIPT 
		var iconListLoaded = {!! json_encode($iconList) !!};
	</script>
	<script src="/js/admin/groupCreate.js" type="text/javascript"></script>
  @endsection

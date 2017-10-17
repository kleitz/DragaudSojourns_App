@extends('layouts.admin.master', [
	'title' => 'Create New Group | Dragaud Custom Sojourns',
])

@section('content')
    <div class="container admin-container">
      <div class="admin-floating-panel z-depth-2 col-xs-8">
        <h3 class="admin-section-header" >New group</h3>
        <form method="POST" action="/groups/store" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group form-inline inline-material-large" style="margin-bottom: 15px !important">
            <label for="number">Group Number</label>
            <input name="number" class="form-control numbers-only material-input" id="group-number" placeholder="">
          </div>
          <div class="form-group">
            <label for="destination">Destination</label>
            <input type="text" name="destination" class="form-control" id="group-destination" placeholder="">
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
            <input type="text" name="school" class="form-control" id="group-school" placeholder="">
          </div>
          <div class="form-group">
            <label for="packages">Packages</label>
            <input type="text" name="packages" class="form-control" id="group-packages" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Trip Icon</label>
            <input type="file" name="icon" id="group-icon" class="form-control-file" aria-describedby="fileHelp">
          </div>
          <div class="form-group">
            <label for="itinerary">Itinerary</label>
            <input type="file" name="itinerary" id="group-itinerary"  class="form-control-file" aria-describedby="fileHelp">
          </div>
          <div class="form-group">
            <label for="release">Release</label>
            <input type="file" name="release" id="group-release" class="form-control-file" aria-describedby="fileHelp">
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" name="message" id="exampleTextarea" rows="3"></textarea>
          </div>
          <button type="submit" class="ds-button button-gen button-locked">Submit</button>
        </form>
      </div>
    </div>
    @endsection

@extends('layouts.admin.master', [
	'title' => 'Admin Settings | Dragaud Custom Sojourns',
])

@section('content')
<div id="admin-settings-app" class="container admin-container">

<div class="col-xs-6 relative" style="z-index: 20">
  <div class="admin-floating-panel z-depth-2">
    <h3 class="admin-section-header" >Settings</h3>
    @if (count($errors) > 0)
    <div class="alert alert-danger" style="border-color:#c98484; margin-bottom: 15px">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="/admin/profile/update" enctype="multipart/form-data" style="margin-bottom: 50px">
      {{ csrf_field() }}

      <div class="form-group form-inline inline-material-large flex-row-start" style="margin-bottom: 15px !important">
        <label for="number">Profile details</label>
      </div>

      <div class="form-group">
        <label for="destination">Admin level</label>
        <input type="text" name="name" class="form-control" placeholder="" required readonly value="{{ title_case($authAdmin->level) }}">
      </div>

      <div class="form-group">
        <label for="destination">Full name</label>
        <input type="text" name="name" class="form-control" placeholder="" required value="{{ $authAdmin->name }}">
      </div>

      <div class="form-group">
        <label for="destination">Email address</label>
        <input type="email" name="email" class="form-control" placeholder="" required value="{{ $authAdmin->email }}">
      </div>

      <button type="submit" name="button" class="ds-button button-gen full-width" style="margin-top: 15px; padding: 3px">Update profile</button>
    </form>

    <form method="POST" action="/admin/auth/edit" enctype="multipart/form-data">
      {{ csrf_field() }}

      <div class="form-group form-inline inline-material-large flex-row-start" style="margin-bottom: 15px !important">
        <label for="number">Change password</label>
      </div>

      <div class="form-group">
        <label for="destination">Current password</label>
        <input type="password"  name="current-pass" class="form-control pass-bullets" placeholder="" required>
      </div>

      <div class="form-group">
        <label for="destination">New password</label>
        <input type="password"  name="new-pass" class="form-control pass-bullets" placeholder="" required>
      </div>
      <div class="form-group">
        <label for="destination">Confirm new password</label>
        <input type="password"  name="confirm-pass" class="form-control pass-bullets" placeholder="" required>
      </div>

      <button type="submit" name="button" class="ds-button button-gen full-width" style="margin-top: 15px; padding: 3px">Change password</button>
    </form>
  </div>
</div>

</div>

@endsection

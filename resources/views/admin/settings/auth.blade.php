@extends('layouts.admin.master', [
	'title' => 'Admin Settings | Dragaud Custom Sojourns',
])

@section('content')
<div id="admin-settings-app" class="container admin-container">

<div class="col-xs-6 relative" style="z-index: 20">
  <div class="admin-floating-panel z-depth-2">
    <h3 class="admin-section-header" >Account settings</h3>
		@if (count($errors) > 0)
		<div class="alert alert-danger" style="border-color:#c98484;">
				<ul>
						@foreach ($errors->all() as $error)
						<li>{!! $error !!}</li>
						@endforeach
				</ul>
		</div>
		@endif

		@if(session()->has('message'))
		<div class="alert alert-success" style="border-color: #76b978">
				 <strong>Success!</strong> {{ session()->get('message') }}
		</div>
		@endif
    <form method="POST" action="/admin/profile/update" enctype="multipart/form-data" style="margin-bottom: 50px">
      {{ csrf_field() }}

      <div class="form-group form-inline inline-material-large flex-row-start" style="margin-bottom: 15px !important">
        <label for="form-profile">Profile details</label>
      </div>

      <div class="form-group">
        <label for="level">Admin level</label>
        <input type="text" name="level" class="form-control" placeholder="" readonly value="{{ title_case($authAdmin->level) }}">
      </div>

      <div class="form-group">
        <label for="name">Full name</label>
        <input type="text" name="name" class="form-control" placeholder="" value="{{ $authAdmin->name }}">
      </div>

      <div class="form-group">
        <label for="email">Email address</label>
        <input type="text" name="email" class="form-control" placeholder="" value="{{ $authAdmin->email }}">
      </div>

      <button type="submit" name="button" class="ds-button button-gen ds-button-slim" style="margin-top: 15px;">Update profile</button>
    </form>

    <form method="POST" action="/admin/auth/edit" enctype="multipart/form-data">
      {{ csrf_field() }}

      <div class="form-group form-inline inline-material-large flex-row-start" style="margin-bottom: 15px !important">
        <label for="form-auth">Change password</label>
      </div>

      <div class="form-group">
        <label for="current-pass">Current password</label>
        <input type="password"  name="current-pass" class="form-control pass-bullets" placeholder="" required>
      </div>

      <div class="form-group">
        <label for="new-pass">New password</label>
        <input type="password"  name="new-pass" class="form-control pass-bullets" placeholder="" required>
      </div>
      <div class="form-group">
        <label for="confirm-pass">Confirm new password</label>
        <input type="password"  name="confirm-pass" class="form-control pass-bullets" placeholder="" required>
      </div>

      <button type="submit" name="button" class="ds-button button-gen ds-button-slim" style="margin-top: 15px">Change password</button>
    </form>
  </div>
</div>

<?php
	$adminAccounts = App\Admin::all();
 ?>

@if ($authAdmin->level == 'System Administrator')

<div class="col-xs-6">
	<div class="admin-floating-panel z-depth-1 relative" style="top: 0px; padding: 35px">
		<h4 class="admin-section-subheader" style="margin-top: 10px">System control </h4>
		<div class="form-group form-inline inline-material-large flex-row-start" style="margin-bottom: 15px !important">
			<label for="number">Accounts</label>
		</div>
		<div class="row linear-expander expanded full-width static" style="padding: 0; border-color: transparent">
			@foreach ($adminAccounts as $admin)
			<div class="panel panel-secure border-panel-light flex-row-start" style="overflow: visible; margin-bottom: 12px">
				<div class="panel-body flex-row-start full-width" style="padding: 0 10px; height: 50px">
					<div class="flex-self-centered dot-dot-dot" style="border-right: 1px solid #ccc; width: 45%; padding: 10px">
						{{ $admin->name }}
					</div>
					<div class="flex-self-centered dot-dot-dot" style="border-right: 1px solid #ccc; width: 45%; padding: 10px">
						{{ title_case($admin->level) }}
					</div>
					<div style="width: 10%; padding: 0 10px" class="flex-row-start show-account-user">
						<a href="/admin/{{ $authAdmin->email }}/system/update/{{ $admin->id }}">
							<div class="admin-nav-icon">
								@include('partials.vector.system')
							</div>
						</a>
						<div class="relative admin-helper-modal hidden">
							<div class="admin-helper">
								<p style="margin:0">Edit settings</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<form method="POST" action="/admin/system/store" enctype="multipart/form-data" style="margin-bottom: 50px">
      {{ csrf_field() }}

			<button id="admin-settings-newbutton" type="button" name="button" class="ds-button button-gen linear-expander-controller ds-button-slim generate-pass-controller" style="margin-bottom: 15px;">+ Create new admin</button>

			<div class="row linear-expander full-width static">

				<div id="admin-settings-newlabel" class="form-group form-inline inline-material-large flex-row-start hidden" style="margin-bottom: 15px !important">
					<label for="number">Create new</label>
				</div>

				<div class="form-group">
					<label for="level">Admin level</label>
					<select class="form-control" name="level">
						<option value="System Administrator">System Adminstrator</option>
						<option value="system moderator">System Moderator</option>
					</select>
				</div>

				<div class="form-group">
	        <label for="name">Full name</label>
	        <input type="text" name="name" class="form-control" placeholder="" value="" required>
	      </div>

	      <div class="form-group">
	        <label for="email">Email address</label>
	        <input type="email" name="email" class="form-control" placeholder="" value="" required>
	      </div>

				<div class="form-group">
					<label for="password">Temporary password:</label>
					<input type="text" readonly name="password" class="form-control generate-pass-output" placeholder="">
				</div>
				<div class="flex-row-start" style="margin-top: 30px">
		      <button type="submit" name="button" class="ds-button button-gen ds-button-slim" style="margin-right:10px;">Confirm</button>
					<button id="admin-settings-newcancel" type="button" name="button" class="ds-button button-cancel ds-button-slim linear-expander-controller">Cancel</button>
				</div>

			</div>
    </form>
	</div>
</div>

@endif

</div>

@endsection

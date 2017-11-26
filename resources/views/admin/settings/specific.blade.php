@extends('layouts.admin.master', [
	'title' => 'Admin Settings | Dragaud Custom Sojourns',
])

@section('content')
<div id="admin-settings-app" class="container admin-container">

<div class="col-xs-6 relative" style="z-index: 20">
  <div class="admin-floating-panel z-depth-2">
    <h3 class="admin-section-header" >{{ $specAdmin->name }}</h3>
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
    <div class="alert alert-success relative" style="border-color: #76b978">
			<strong>Success!</strong> {{ session()->get('message') }}
			@if(session()->has('throughPass')) to:	@endif
			@if(session()->has('throughPass'))
				<input type="text" name="name" class="form-control absolute through-pass" value="{{ session()->get('throughPass') }}" readonly>
			@endif
    </div>
		@endif

    <form method="POST" action="/admin/profile/update" enctype="multipart/form-data" style="margin-bottom: 50px">
      {{ csrf_field() }}

      <div class="form-group form-inline inline-material-large flex-row-start" style="margin-bottom: 15px !important">
        <label for="form-profile">Edit account</label>
      </div>

			<div class="form-group">
				<label for="level">Admin level</label>
				<select class="form-control" name="level">
					<?php
						$sysadmin = 'selected';
						$sysmod = '';
						if ($specAdmin->level != 'System Administrator') {
							$sysadmin = '';
							$sysmod = 'selected';
						}
					 ?>
					<option value="System Administrator" {{ $sysadmin }}>System Adminstrator</option>
					<option value="System Moderator" {{ $sysmod }}>System Moderator</option>
				</select>
			</div>

      <div class="form-group">
        <label for="name">Full name</label>
        <input type="text" name="name" class="form-control" placeholder="" value="{{ $specAdmin->name }}">
      </div>

      <div class="form-group">
        <label for="email">Email address</label>
        <input type="text" name="email" class="form-control" placeholder="" value="{{ $specAdmin->email }}">
      </div>

			<input type="hidden" name="admin_id" value="{{ $specAdmin->id }}">

			<div class="flex-row-start" style="margin-top: 15px;">
	      <button type="submit" name="button" class="ds-button button-gen ds-button-slim" style="margin-right: 15px">Update account</button>
				<a href="/admin/system/destroy/{{ $specAdmin->id }}" name="button" class="gfocus-button ds-button gc-delete auto-width">Delete account</a>
			</div>
    </form>

    <form method="POST" action="/admin/auth/edit" enctype="multipart/form-data">
      {{ csrf_field() }}

      <div class="form-group form-inline inline-material-large flex-row-start" style="margin-bottom: 15px !important">
        <label for="form-auth">Create password</label>
      </div>

      <div class="form-group">
        <label for="new-pass">Temporary password</label>
        <input type="text" readonly name="new-pass" class="form-control generate-pass-output" placeholder="" required>
      </div>

			<input type="hidden" name="admin_id" value="{{ $specAdmin->id }}">

      <button type="submit" name="button" class="ds-button button-gen ds-button-slim" style="margin-top: 15px">Change password</button>
    </form>
  </div>
</div>

</div>

@endsection

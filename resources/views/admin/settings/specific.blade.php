@extends('layouts.admin.master', [
	'title' => 'Admin Settings | Dragaud Custom Sojourns',
])

@section('content')
<div id="admin-settings-app" class="container admin-container">

<div class="col-xs-12 relative" style="z-index: 20">
	<div class="admin-split-panel z-depth-2">
		<div class="split-panel-header">
			<h3 class="admin-section-header" style="margin: 1.5rem 15px 2rem">Settings / {{ $specAdmin->name }}</h3>
		</div>
		<div class="split-panel-content">
			<div class="row" style="margin: 0">
			  <div  class="col-xs-6">
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

			    <form method="POST" action="/admin/profile/update" enctype="multipart/form-data" class="admin-short-form">
			      {{ csrf_field() }}
						<div class="panel z-depth-custom" style="border-radius: 2px">
							<div class="panel-body" style="padding: 20px 20px 30px">
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
					        <input type="text" name="name" class="form-control" placeholder="" required value="{{ $specAdmin->name }}">
					      </div>

					      <div class="form-group">
					        <label for="email">Email address</label>
					        <input type="email" name="email" class="form-control" placeholder="" required value="{{ $specAdmin->email }}">
					      </div>

								<input type="hidden" name="admin_id" value="{{ $specAdmin->id }}">

								<div class="flex-row-start" style="margin-top: 15px;">
						      <button type="submit" name="button" class="ds-button button-gen ds-button-slim" style="margin-right: 15px">Update account</button>
									<a id="remove-admin-begin" href="javascript:;" name="button" class="gfocus-button ds-button gc-delete auto-width ds-button-slim">Delete account</a>
								</div>
							</div>
						</div>
			    </form>

			    <form method="POST" action="/admin/auth/edit" enctype="multipart/form-data" class="admin-short-form">
			      {{ csrf_field() }}
						<div class="panel z-depth-custom" style="border-radius: 2px">
							<div class="panel-body" style="padding: 20px 20px 30px">
					      <div class="form-group form-inline inline-material-large flex-row-start" style="margin-bottom: 15px !important">
					        <label for="form-auth">Create password</label>
					      </div>

					      <div class="form-group">
					        <label for="new-pass">Temporary password</label>
					        <input type="text" readonly name="new-pass" class="form-control generate-pass-output" placeholder="" required>
					      </div>

								<input type="hidden" name="admin_id" value="{{ $specAdmin->id }}">

					      <button type="submit" name="button" class="ds-button button-gen ds-button-slim" style="margin-top: 15px">Change password</button>
							</div>
						</div>
			    </form>

			  </div>
			</div>
		</div>
	</div>
</div>

</div>

<div id="settings-overlay" class="dark-overlay-gen fix-fill hidden">
	<div class="abs-fill hidden" id="remove-admin-modal" style="z-index: 500">
	  <div class="flex-abs-center full-height">

	    <div  class="panel panel-secure full-width flex-col-center absolute" style="max-width: 380px; height: 200px">
	        <div style="margin: 0 30px">
	          <p class="text-center">
	            Permanently remove <span style="font-weight: 500; margin: 0 2px; font-style: italic">{{ $specAdmin->name }}</span> from the list of {{ title_case($specAdmin->level) }}'s?
	          </p>
	          <div class="flex-row-center" style="margin-top: 15px">
							<a href="/admin/system/destroy/{{ $specAdmin->id }}" name="button" class="ds-button button-gen waves-effect waves-light" style="margin-right: 15px">Delete</a>
	            <button id="remove-admin-cancel" type="button" class="ds-button button-gen waves-effect waves-light button-cancel">Cancel</button>
	          </div>
	        </div>
	    </div>

	  </div>
	</div>
</div>

@endsection

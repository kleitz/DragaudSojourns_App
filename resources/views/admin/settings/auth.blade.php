@extends('layouts.admin.master', [
	'title' => 'Admin Settings | Dragaud Custom Sojourns',
])

@section('content')
<div id="admin-settings-app" class="container admin-container">
	<div class="col-xs-12" style="z-index: 20">
		<div class="admin-split-panel z-depth-2">
			<div class="split-panel-header">
				<h3 class="admin-section-header" style="margin: 1.5rem 15px 2rem">Settings | {{ auth('admin')->user()->name }}</h3>
			</div>
			<div class="split-panel-content">
				<div class="row" style="margin:0">
					<div class="col-xs-6 relative" style="z-index: 20">
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
					    <form class="admin-short-form"  method="POST" action="/admin/profile/update" enctype="multipart/form-data" style="margin-bottom: 30px">
					      {{ csrf_field() }}
								<div class="panel z-depth-custom" style="border-radius: 2px">
									<div class="panel-body" style="padding: 20px 20px 30px">
										<div class="form-group form-inline inline-material-large flex-row-start" style="margin-bottom: 15px !important">
											<label for="form-profile">My profile details</label>
										</div>

										<div class="form-group">
											<label for="level">Admin level</label>
											<input type="text" name="level" class="form-control" placeholder="" readonly value="{{ title_case($authAdmin->level) }}">
										</div>

										<div class="form-group">
											<label for="name">Full name</label>
											<input type="text" name="name" class="form-control" placeholder="" required value="{{ $authAdmin->name }}">
										</div>

										<div class="form-group">
											<label for="email">Email address</label>
											<input type="email" name="email" class="form-control" placeholder="" required value="{{ $authAdmin->email }}">
										</div>

										<button type="submit" name="button" class="ds-button button-gen ds-button-slim" style="margin-top: 15px;">Update profile</button>
									</div>
								</div>
					    </form>

					    <form class="admin-short-form"  method="POST" action="/admin/auth/edit" enctype="multipart/form-data">
					      {{ csrf_field() }}

								<div class="panel z-depth-custom" style="border-radius: 2px">
									<div class="panel-body" style="padding: 20px 20px 30px">
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
									</div>
								</div>
					    </form>
					  </div>
						<?php
							$adminAccounts = App\Admin::all();
						 ?>
					@if ($authAdmin->level == 'System Administrator')
					<div class="col-xs-6">
							<div class="row linear-expander expanded full-width static" style="padding-top: 0; margin: 0; border-color: transparent">
							<div class="panel z-depth-custom" style="border-radius: 2px">
								<div class="panel-body" style="padding: 20px 20px 30px">
									<div class="form-group form-inline inline-material-large flex-row-start" style="margin-bottom: 15px !important">
										<label for="number">View all administrators</label>
									</div>
										@foreach ($adminAccounts as $admin)
										<div class="pointer show-account-user flex-row-start" onclick="window.location = '/admin/{{ $authAdmin->email }}/system/update/{{ $admin->id }}';">
											<div class="panel z-depth-custom flex-row-start full-width" style="overflow: visible; margin-bottom: 12px; border-radius: 2px">
												<div class="panel-body flex-row-start full-width" style="padding: 0 10px; height: 50px">
													<div class="flex-self-centered dot-dot-dot" style="border-right: 1px solid #ccc; width: 45%; padding: 10px">
														{{ $admin->name }}
													</div>
													<div class="flex-self-centered dot-dot-dot" style="border-right: 1px solid #ccc; width: 45%; padding: 10px">
														{{ title_case($admin->level) }}
													</div>
													<div style="width: 10%; padding: 0 10px" class="flex-row-start">
														<a href="/admin/{{ $authAdmin->email }}/system/update/{{ $admin->id }}">
															<div class="admin-nav-icon">
																@include('partials.vector.system')
															</div>
														</a>
													</div>
												</div>
											</div>
											<div class="relative admin-helper-modal hidden">
												<div class="admin-helper">
													<p style="margin:0">Edit settings</p>
												</div>
											</div>
										</div>
										@endforeach
									</div>
								</div>
							</div>
							<form class="admin-short-form"  method="POST" action="/admin/system/store" enctype="multipart/form-data">
					      {{ csrf_field() }}

								<button id="admin-settings-newbutton" type="button" name="button" class="ds-button button-gen linear-expander-controller ds-button-slim generate-pass-controller" style="margin-bottom: 25px;">+ Create new admin</button>

								<div class="row linear-expander full-width static" style="border-bottom: transparent; margin: 0">
									<div class="panel z-depth-custom" style="border-radius: 2px">
										<div class="panel-body" style="padding: 20px 20px 30px">
											<div id="admin-settings-newlabel" class="form-group form-inline inline-material-large flex-row-start hidden" style="margin-bottom: 15px !important">
												<label  for="number">Create new admin</label>
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
									</div>
								</div>
					    </form>
						</div>
					@endif

				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@extends('layouts.admin.public', [
	'title' => 'Admin Login | Dragaud Custom Sojourns',
	'header' => ''
])

@section('content')
<div style="padding: 0 15px">
<div class="floating-div border-panel panel-default">
  <div class="panel-heading pwreset-heading">Administrator Login</div>
  <div class="row panel-body" style="padding: 50px 80px 30px">
			<div class="col-xs-4">
				<div class="flex-col-start">
					@if (count($errors) > 0)
					<div class="alert alert-danger" style="border-color:#c98484; margin-bottom: 15px">
							<ul>
									@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
									@endforeach
							</ul>
					</div>
					@endif
					<div class="panel-default border-panel panel">
						<div class="panel-body">
								<p style="margin:0">Use a valid username and password to access the administrator back-end.</p>
						</div>
					</div>
				</div>
			</div>
      <div class="col-xs-8">
          <div class="panel panel-default border-panel">

              <div class="panel-body pwreset-body">
                  <form class="form-horizontal" method="POST" action="{{ route('admin.login.submit') }}">
                      {{ csrf_field() }}

                      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="email" class="col-xs-3 control-label">E-Mail Address</label>

                          <div class="col-xs-7">
                              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                              @if ($errors->has('email'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password" class="col-xs-3 control-label">Password</label>

                          <div class="col-xs-7">
                              <input id="password" type="password" class="form-control pass-format" name="password" required>

                              @if ($errors->has('password'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-xs-7 col-xs-offset-3">
                            <div class="flex-row-between">
                              <div class="checkbox" style="padding: 0">
                                  <label>
                                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                  </label>
                              </div>
                              <a style="margin-bottom: 5px; font-size: 14px" href="javascript:;" id="admin-pwreset">
                                  Forgot Your Password?
                              </a>
                            </div>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-xs-4 col-xs-offset-3">
                              <button type="submit" class="col-xs-12 waves-effect waves-light ds-button button-gen full-width">
                                  Login
                              </button>

                          </div>
                      </div>

                  </form>
              </div>
          </div>
      </div>
  </div>
</div>

</div>
	<script>$(".login-container").hide()</script>
@endsection

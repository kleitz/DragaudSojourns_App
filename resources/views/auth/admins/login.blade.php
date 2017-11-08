@extends('layouts.admin.public', [
	'title' => 'Admin Login | Dragaud Custom Sojourns',
	'header' => ''
])

@section('content')
  <div class="row">
      <div class="col-xs-8 col-xs-offset-2 ">
          <div class="panel panel-default border-panel floating-div">
              <div class="panel-heading pwreset-heading">Administrator Login</div>

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
                              <a class="flex-col-center" href="javascript:;" id="admin-pwreset">
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
	
	<script>$(".login-container").hide()</script>
@endsection

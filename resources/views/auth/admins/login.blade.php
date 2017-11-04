<!DOCTYPE html>
<html>
<head>
  <!-- Meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="User profile with Dragaud Sojourns'">
  <meta name="robots" content="index,follow">
  <meta name="googlebot" content="index,follow">
  <meta name="google" content="notranslate">
  <meta name="rating" content="General">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Site ref  -->
  <title>Admin Login | Dragaud Custom Sojourn</title>
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/public/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/public/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/public/favicon/favicon-16x16.png">
  <link rel="manifest" href="/assets/public/favicon/manifest.json">
  <link rel="mask-icon" href="/assets/public/favicon/safari-pinned-tab.svg" color="#cb9753">
  <link rel="shortcut icon" href="/assets/public/favicon/favicon.ico">
  <meta name="msapplication-config" content="/assets/public/favicon/browserconfig.xml">
  <meta name="theme-color" content="#cb9753">
  <!--CSS -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="/css/user.css" rel="stylesheet" type="text/css" />
  <!--start slides-->
  <script src="/js/user/preload.js" type="text/javascript"></script>

</head>

<body>
    <div class="backgroundtop">
      <img src="{{ url('/assets/public/img/dragoo-top.png') }}"/>
    </div>
    @include('partials.login.button')
    <div class="container">
      <a href="/" class="header-logo">
        @include('partials.vector.header')
      </a>
      <div class="content-wrapper">
      	<div class="content-container nav-container">
      		@include('layouts.user.navtop')
          <div class="content-main row" id="accountApp">
            <div class="col-xs-7 col-xs-offset-2" >
              <h3 class="font-light account-title"></h3>
            </div>
              <div class="row">
                  <div class="col-xs-8 col-xs-offset-2 " style="margin-top: 100px;margin-bottom: 50px;">
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
                                          <a class="flex-col-center" href="{{ route('password.request') }}">
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
            </div>
          </div>
        </div>
      <div class="content-wrapper">
    <div class="content-container">
  <div class="content-main">
    @include('layouts.user.nav_slider')
  </div>
</div>
</div>
</div>
@include('layouts.public.footer')
@include('layouts.user.overlay')
</body>
<script>
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
</script>
<script src="/js/user/app.js" type="text/javascript"></script>
</html>

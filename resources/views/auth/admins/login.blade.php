<!DOCTYPE html>
<html>
<head>
  <!-- Meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Administrator with Dragaud Sojourns'">
  <meta name="robots" content="index,follow">
  <meta name="googlebot" content="index,follow">
  <meta name="google" content="notranslate">
  <meta name="rating" content="General">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Site ref  -->
  <title>Admin Login | Dragaud Custom Sojourns</title>
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
  <link href="/css/admin.css" rel="stylesheet" type="text/css" />
  <!--start slides-->
  <script src="/js/admin/preload.js" type="text/javascript"></script>
  <script src="/js/Chart.js" type="text/javascript"></script>
  <script src="http://code.gijgo.com/1.5.1/js/gijgo.js" type="text/javascript"></script>
  <link href="http://code.gijgo.com/1.5.1/css/gijgo.css" rel="stylesheet" type="text/css" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

<body>
    <div class="admin-banner">
      <div class="backgroundtop">
        <img src="{{ url('/assets/public/img/dragoo-top.png') }}"/>
      </div>
      <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <a href="/" class="header-logo" style="margin-left: 0px">
                @include('partials.vector.header')
              </a>
            </div>
          </div>
      </div>
    </div>
    <div class="admin-main-panel row">
      <div class="full-width admin-runner" style="height: 120px"></div>
      <div class="admin-content" id="admin-app" style="top: -80px">
      <div class="container">
          <div class="row">
              <div class="col-md-8 col-md-offset-2">
                  <div class="panel panel-default z-depth-2">
                      <div class="panel-heading">Admin login</div>

                      <div class="panel-body">
                          <form class="form-horizontal" method="POST" action="{{ route('admin.login.submit') }}">
                              {{ csrf_field() }}

                              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                  <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                  <div class="col-md-6">
                                      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                      @if ($errors->has('email'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('email') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                  <label for="password" class="col-md-4 control-label">Password</label>

                                  <div class="col-md-6">
                                      <input id="password" type="password" class="form-control" name="password" required>

                                      @if ($errors->has('password'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group">
                                  <div class="col-md-6 col-md-offset-4">
                                      <div class="checkbox">
                                          <label>
                                              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                          </label>
                                      </div>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <div class="col-md-8 col-md-offset-4">
                                      <button type="submit" class="btn btn-primary">
                                          Login
                                      </button>

                                      <a class="" href="{{ route('password.request') }}">
                                          Forgot Your Password?
                                      </a>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
    </div>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script src="/js/admin/app.js" type="text/javascript"></script>
</html>

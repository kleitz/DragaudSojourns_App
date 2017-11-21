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
  <title>{{ $title }}</title>
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

  <!--start google-->
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXe85QiSlNnEDm8kGZI2IFL7WH-KogeHc" type="text/javascript"></script>

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
            <div class="col-xs-12" >
              <h3 class="font-light account-title">{{ $header }}</h3>
            </div>
            @yield('content')
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
  <!-- Overlay -->
	<div id="dark-overlay" class="dark-overlay-gen fix-fill flex-abs-center hidden">
		<!-- Password reset modal -->
			<div id="overlay-admin-pwreset" class="overlay-rounded-wrapper flex-row-between overlay-near-shadow hidden">
				<div class="overlay-content-wide overlay-pwreset" style="box-sizing: border-box; max-width: 380px; padding: 30px 50px">
					<h3 class="overlay-wide-header">Forgot your password?</h3>
					<p class="overlay-wide-msg">No problem. Confirm your email below and we'll send you a reset link.</p>
					<div class="modal-ds-form" id="admin-pwreset-form">
						<div class="form-group" >
							<input id="pwreset-email" class="form-control" name="login-email" type="text" placeholder="Email" style="height: 40px"></input>
						</div>
            <div class="relative">
              <span id="pwreset-email-err" class="absolute ds-form-errmsg" style="left: 0; top: -20px">Please enter a valid email</span>
            </div>
						<div id="pwreset-exists" class="input-add-err hidden" style="top: -6px">
							<input class="ds-form-error ds-details-err" style="height: 40px" readonly type="text" value="We don't have this email in our records.">
								<img src="/assets/images/icons/hazard_tri.png" class="input-hazard" style="top: -17px"/>
							</input>
						</div>
						<div class="flex-row-center">
							<a href="javascript:;" id="pwreset-confirm" class="overlay-wide-button ds-button button-gen">Reset</a>
							<a href="javascript:;" id="pwreset-cancel" class="overlay-wide-button ds-button button-cancel">Cancel</a>
						</a>
					</div>
				</div>
			</div>
		</div>
		<!-- Loading password reset -->
		@include('partials.overlay.loader', [
		  'id' => 'pwreset-loader',
		  'header' => 'Please wait...',
		  'msg' => "We're resetting your password"
		])
		<!-- Password successfully reset -->
		@include('partials.overlay.success', [
		  'id' => 'pwreset-success',
		  'header' => 'New password sent',
		  'msg' => 'Please check your inbox for the new password',
		  'button' => 'Continue'
		])
	</div>
</body>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script src="/js/user/app.js" type="text/javascript"></script>
<script src="/js/admin/login.js" type="text/javascript" ></script>
</html>

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
              <h3 class="font-light account-title"><a href="/profile/{{ auth()->user()->email }}">My Account</a></h3>
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
<script src="/js/user/render.js" type="text/javascript"></script>
</html>

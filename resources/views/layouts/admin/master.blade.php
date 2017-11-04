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
      <div class="relative" style="z-index: 10; top: -25px">
        @include('partials.login.button')
      </div>
      <div class="backgroundtop">
        <img src="{{ url('/assets/public/img/dragoo-top.png') }}"/>
      </div>
      <a href="/" class="header-logo">
        @include('partials.vector.header')
      </a>
    </div>
    <div class="admin-main-panel row">
      <div class="full-width admin-runner">
        <div class="admin-username">
          <div class="flex-row-start">
            <div class="admin-picture-container">
              <img src="/assets/images/icons/admin_cog.png" alt="">
            </div>
            <div class="flex-col-center">
              <h5>{{ auth('admin')->user()->name }}</h5>
              <p>{{ auth('admin')->user()->level }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="full-width flex-row-start">
        <div class="admin-navigation">
          @include('layouts.admin.nav')
        </div>
        <div class="admin-content" id="admin-app">
          @yield('content')
        </div>
      </div>
    </div>
</body>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script src="/js/admin/app.js" type="text/javascript"></script>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

  <title>{{ $title }}</title>

  <!--start meta-->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ url('assets/public/favicon/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ url('assets/public/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets/public/favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ url('assets/public/favicon/manifest.json') }}">
  <link rel="mask-icon" href="{{ url('assets/public/favicon/safari-pinned-tab.svg') }}" color="#cb9753">
  <link rel="shortcut icon" href="{{ url('assets/public/favicon/favicon.ico') }}">
  <meta name="msapplication-config" content="{{ url('assets/public/favicon/browserconfig.xml') }}">
  <meta name="theme-color" content="#cb9753">

  <META NAME="Author" "VN Web Designs">
  <META NAME="Description" CONTENT="Dragaud Custom Sojourns has been leading these small group student and private tours worldwide since 1995, working with middle schools, high schools, and universities to provide students a chance to truly embrace new ideas and experiences. Join us in our ongoing quest to seek out those unusual and special places and flavors found in every culture. ">
  <META NAME="Keywords" CONTENT="Student tours, Private tours, Foreign exchange, student travel, custom tours, international travel, educational experiences, class trips, study abroad">
  <META NAME="Robots" CONTENT="All">

  <!--end meta-->

  <!--start css-->
  <link href="{{ url('/assets/public/css/sojournsstyle.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ url('/assets/public/css/global.css') }}" rel="stylesheet" type="text/css" />
  <!--end css-->

  <!--start cufon-->
  <script src="{{ url('/assets/public/js/cufon-yui.js') }}" type="text/javascript"></script>
	<script src="{{ url('/assets/public/js/District_100.font.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		Cufon.replace('h1');
		Cufon.replace('h2');
	</script>
  <!--end cufon-->

  <!--start slides-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
  <script src="{{ url('/assets/public/js/slides.min.jquery.js') }}"></script>


  	<script>
  		$(function(){
  			$('#slides').slides({
  				preload: true,
  				preloadImage: "{{ url('/assets/public/img/loading.gif') }}",
  				play: 5000,
  				pause: 2500,
    				slideSpeed: 1000,
  				hoverPause: true,
  				animationStart: function(current){
  					$('.caption').animate({
  						bottom:-35
  					},100);
  					if (window.console && console.log) {
  						// example return of current slide number
  						console.log('animationStart on slide: ', current);
  					};
  				},
  				animationComplete: function(current){
  					$('.caption').animate({
  						bottom:0
  					},200);
  					if (window.console && console.log) {
  						// example return of current slide number
  						console.log('animationComplete on slide: ', current);
  					};
  				},
  				slidesLoaded: function() {
  					$('.caption').animate({
  						bottom:0
  					},200);
  				}
  			});
  		});

  			$(function(){
  			$('#slides2').slides({
  				preload: true,
  				preloadImage: "{{ url('/assets/public/img/loading.gif') }}",
                  slideSpeed: 1750,

  			});
  		});
  	</script>
  <!--end slides-->

  <!--start preload-->
  <script type="text/javascript">
  function MM_preloadImages() { //v3.0
    var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
      var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
      if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
  }

  </script>
  <!--end preload-->

  <!--start google-->
  <script type="text/javascript">
  var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-22801025-4']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();


  </script>
  <!--end google-->

</head>

<body onload="MM_preloadImages( '/assets/public/img/dragoo-top.png', '/assets/public/img/header.png' )">
  <div class="backgroundtop">
    <img src="{{ url('/assets/public/img/dragoo-top.png') }}"/>
  </div>

  <div class="container">
    <div class="header">
      <a href="{{ url('/') }}" class="studenttoursheader"><h1>Student Tours of Distinction</h1></a>
      <a href="{{ url('/') }}"class="logo">Dragaud Custom Sojourns</a>
    </div><!--close header-->
    @yield('content')
    @include('layouts.public.nav_slider')
  </div><!--close container-->
  @include('layouts.public.footer')
</body>
</html>

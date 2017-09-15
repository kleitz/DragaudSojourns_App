@extends('layouts.public.master', [
	'title' => 'Student Tours | Dragaud Custom Sojourns',
])

@section('content')

<div class="boxwrap">
	<div class="contentbox">

		@include('layouts.public.navtop')

    <div class="mainbox">

    <div class="topbox" id="studenttoursbox">

    <div class="headerbar" id="indexbar">
    <h1 id="bigh1">
    Student Tours
    </h1>
    </div><!--close headerbar-->

    <div id="studenttours-img">
    </div>
    <div class="maintext-fix" id="indextext">

     <p>Travel is a mind-expanding experience that changes us for the  better and nothing offers more value to students thirsty for knowledge.   It is an education in and of itself, an opportunity for students to  connect with varying cultures and peoples, a perfect medium for a better  understanding of the world and our place in it.  The opportunity to  work with teachers and students has proven to be one of the most  satisfying aspects of my business and I hope you will choose to join us  in this exploration of all the world has to offer.</p>

     <p>
     We currently offer Student Tours to <a href="{{ url('/newyork') }}"><h2>New York</h2></a>,<a href="{{ url('/london') }}"><h2> London</h2></a>, and <a href="{{ url('/greece') }}"><h2>Greece</h2></a>
    as well as general interest student tours to New York, Washington D.C.,  Boston, most European countries, Australia, and New Zealand.
    </div>


    </div><!--end topbox-->

    <!--start banner-->
    <div class="midbox" id="newyorkbox">

    <div class="bannerbar">

    <div class="bannerbox">
    <h1 class="bannertitle">
    <a href="{{ url('/newyork') }}">
    New York
    </a>
    </h1>
    <h2 class="bannerreadmore">
    <a href="{{ url('/newyork') }}">
    read more
    </a>
    </h2>
    <div class="fleur" id="bannerfleur">
    </div>
    </div>

     <div class="bannertext">
      <p>With almost 50 million people choosing to visit each year, New York is  deservedly one of the world's most renowned cities.   A true melting pot  in the grand American tradition, New York offers something for everyone... </p>

    </div><!--end bannertext-->

    </div>

    </div>

    <!--end BANNER-->


    <!--start banner-->
    <div class="midbox" id="londonbox">

    <div class="bannerbar">

    <div class="bannerbox">
    <h1 class="bannertitle">
    <a href="{{ url('/london') }}">
    London
    </a>
    </h1>
    <h2 class="bannerreadmore">
    <a href="{{ url('/london') }}">
    read more
    </a>
    </h2>
    <div class="fleur" id="bannerfleur">
    </div>
    </div>

     <div class="bannertext">
     <p>London is without doubt the theater capital of Britain and is possessed of an enduring theatrical tradition.  With over 50 West End theaters, the Royal National Theater's 3 venues, and the continued presence of the Royal Shakespeare...</p>

    </div><!--end bannertext-->

    </div>

    </div>

    <!--end BANNER-->

    <!--start banner-->
    <div class="midbox" id="greecebox">

    <div class="bannerbar">

    <div class="bannerbox">
    <h1 class="bannertitle">
    <a href="{{ url('/greece') }}">
    Greece
    </a>
    </h1>
    <h2 class="bannerreadmore">
    <a href="{{ url('/greece') }}">
    read more
    </a>
    </h2>
    <div class="fleur" id="bannerfleur">
    </div>
    </div>

     <div class="bannertext">
     <p>The birthplace of theater and the center of the classical world, Greece is renowned the world over for its antiquities.  From the solitary fortresses of Meteora to the ancient sites of Delphi and ancient Corinth and on to the splendors of the Acropolis...</p>

    </div><!--end bannertext-->

    </div>

    </div>

    <!--end BANNER-->



  </div>
</div>

@endsection

@extends('layouts.public.master', [
	'title' => 'About Us | Dragaud Custom Sojourns',
])

@section('content')

<div class="boxwrap">
	<div class="contentbox">

		@include('layouts.public.navtop')

    <div class="mainbox" id="paddingbottom">

    <div class="topbox">

    <div class="headerbar">
    <h1 id="bigh1">About Us</h1>
    </div><!--close headerbar-->
    <div id="aboutus-img">
    </div>
    <div id="aboutus-img-sm"></div>
    <div class="maintext" id="excellent-txt">

     <p> Dragaud Custom Sojourns was established to offer travelers an alternative to the usual impersonal form of mass travel.  It is simply not enough to see the world through bus windows.  To truly appreciate a country you must smell, taste, feel, and hear as well.  The rigidly regimented, unimaginative itineraries of many package tour companies leave you with little choice or free time.  My goal is a different, more rewarding kind of vacation, traveling at a slower pace and allowing you to savor the many nuances of a given country or region.  I offer you an inside view of these fascinating corners of the world by combining my knowledge, experience, and contacts to present you and your students with the unique opportunity to witness local events and traditions not mentioned in any guidebook.  One of the best parts of traveling is discovering and I strive to ensure that this indispensable facet of any memorable trip is not suppressed, instead allowing you the time to saunter along the back streets, move in concert with the rhythm of daily life, and savor the many nuances a place has to offer.  This is learning in its broadest sense, through doing. <br />
     </p>
     <p>I have been leading these small group tours worldwide since 1995, working with middle schools, high schools, and universities to provide students a chance to truly embrace new ideas and experiences, and the personal nature of the business has given me great satisfaction.  I believe that you, too, will appreciate this different way of traveling.  It is always a pleasure to share with like-minded people my love of this world and her many diverse cultures and I can assure you of my personal care and attention throughout.  I do hope you will join me in my ongoing quest to seek out those unusual and special places that immerse one in the multitude of flavors to be found in every culture, for a journey is always better when shared. </p>
    <p>
    <h2>
    <a href="{{ url('/contactus') }}">Contact us</a>
    </h2>
    for more info.
    </p>
    </div>

    </div><!--end topbox-->
    </div><!--end mainbox-->

  </div>
</div>

@endsection

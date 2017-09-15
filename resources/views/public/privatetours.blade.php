@extends('layouts.public.master', [
	'title' => 'Private Tours | Dragaud Custom Sojourns',
])

@section('content')

<div class="boxwrap">
	<div class="contentbox">

		@include('layouts.public.navtop')
    <div class="mainbox">

<div class="topbox" >

<div class="headerbar" id="indexbar">
<h1 id="bigh1">Private Tours</h1>
</div><!--close headerbar-->

<div id="privatetours-img">
</div>
<div class="maintext" id="privatetoursbox">

  <p>I firmly believe that the best way to enhance your voyage is to guarantee that you will always be permitted to travel in your own private group and never be asked to join others that you do not know.  The freedom and peace of mind that comes with a flexible, customized itinerary crafted specifically for you is paramount.  Enrichment and discovery are the best parts of travel and I try to ensure that these indispensable facets of a memorable trip are not suppressed, but encouraged, and working with private groups is the best way to do so.
</p>


  </div>


</div><!--end topbox-->

<!--start banner-->
<div class="midbox" id="foodbox">

<div class="bannerbar">

<div class="bannerbox">
<h1 class="bannertitle">
<a href="{{ url('/foodandhotels') }}">
Food and Hotels
</a>
</h1>
<h2 class="bannerreadmore">
<a href="{{ url('/foodandhotels') }}">
read more
</a>
</h2>
<div class="fleur" id="bannerfleur">
</div>
</div>

 <div class="bannertext">
   <p> Whatever the destination, a great deal of emphasis is placed on the quality of accommodation and dining. Centrally located hotels in prime locations are essential. Staying in the very heart of the city allows you to interact directly with the residents  ...</p>

</div><!--end bannertext-->

</div>

</div>

<!--end BANNER-->



</div><!--end mainbox-->

  </div>
</div>

@endsection

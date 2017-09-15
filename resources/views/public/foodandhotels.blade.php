@extends('layouts.public.master', [
	'title' => 'Greece | Dragaud Custom Sojourns',
])

@section('content')

<div class="boxwrap">
	<div class="contentbox">

		@include('layouts.public.navtop')
    <div class="mainbox" id="paddingbottom">

    <div class="topbox">

    <div class="headerbar">
    <h1 id="bigh1">Food and Hotels</h1>
    </div><!--close headerbar-->
    <div id="roomboard-img">
    </div>
    <div id="roomboard-img-sm"></div>
    <div class="maintext" id="excellent-txt">

     <p>
    Whatever the destination, a great deal of emphasis is placed on the quality of accommodation and dining.  Centrally located hotels in prime locations are essential.  Staying in the very heart of the city allows you to interact directly with the residents themselves and experience their way of life as a participant rather than a simple observer.  Guided walks and the use of public transportation reveal the true character of a place and allow you to take in its unique atmosphere.
    </p>
    <p>
    Memorable dining is the other essential ingredient of a great journey as food is often the true embodiment of a city or region.  Great pride is taken in offering you superb meals with an emphasis on local cuisine, always with the chance to choose freely from the menu.</p>

    </div>



    </div><!--end topbox-->
    </div><!--end mainbox-->

  </div>
</div>

@endsection

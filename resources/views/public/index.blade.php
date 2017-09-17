@extends('layouts.public.master', [
	'title' => 'Dragaud Custom Sojourns | Student and Private Tours',
])

@section('content')

<div class="boxwrap">
	<div class="contentbox">

		@include('layouts.public.navtop')

		<div class="mainbox" id="index">
			<div id="container">
				<div id="example">
					<div id="slides">
						<div class="slides_container">
							<div class="slide">
								<a href="Greece.html" title="Student Tours to Greece">
									<img src="{{ url('/assets/public/img/slideshow/1.jpg') }}"  width="833" height="415" alt="slide1" />
								</a>
								<div class="caption">
									<div class="captiontitle">
										<h1>Greece</h1>
									</div>
									<div class="description">
									The birthplace of theater and the center of the classical world
									</div>
									<div class="readmore">
									<h2>
										<a href="/greece">
										read more
										</a>
									</h2>
									</div>
									<div class="fleur" id="captionfleur">
									</div>
								</div>
							</div>
							<div class="slide">
								<a href="newyork.html" title="Student Tours to New York">
									<img src="{{ url('/assets/public/img/slideshow/2.jpg') }}" width="833" height="415" alt="slide2" /></a>
								<div class="caption">
								  <div class="captiontitle">
										<h1>
										new York
										</h1>
									</div>
									<div class="description">
									The best of Broadway and the magic of America’s great metropolis
									</div>
									<div class="readmore">
										<h2>
											<a href="/newyork">
											read more
											</a>
										</h2>
									</div>
									<div class="fleur" id="captionfleur">

									</div>
								</div>
							</div>
							<div class="slide">
								<a href="london.html" title="Student Tours to London"><img src="{{ url('/assets/public/img/slideshow/3.jpg') }}"  width="833" height="415" alt="slide3" /></a>
								<div class="caption">
									<div class="captiontitle">
										<h1>
										London
										</h1>
									</div>
									<div class="description">
									British theater and culture in one of the world’s most famous cities
									</div>
									<div class="readmore">
										<h2>
											<a href="/london">
											read more
											</a>
										</h2>
									</div>
									<div class="fleur" id="captionfleur">

									</div>
								</div>
							</div>
						</div>
						<a href="#" class="prev"><img src="{{ url('/assets/public/img/arrow-prev.png') }}" width="35" height="89" alt="Arrow Prev" /></a>
						<a href="#" class="next"><img src="{{ url('/assets/public/img/arrow-next.png') }}" width="35" height="89" alt="Arrow Next" /></a>
					</div>
				</div>
			</div>
		</div><!--end mainbox-->
	</div><!--end contentbox-->
</div><!--end boxwrap-->

<div class="boxwrap" id="midindex">
	<div class="mainbox" id="leftbox">
		<div class="midbox">
		  <a href="messagefrommichael.html" id="micheal">
		    A Message From Michael Dragoo
		  </a>
		   <a href="{{ url('/messagefrommichael') }}" >
				   <h2 id="boxtitle">
				 A Message From Michael
				 </h2>
			  </a>
		  <p id="readmore">
			  Despite it’s rather formal name, Dragaud Custom Sojourns is in actuality nothing more than one man’s dream: a Dream born of...
			  <br />
			  <br />
			  <a class="rightfloat" href="{{ url('/messagefrommichael') }}">
				  <h2>Read More</h2>
			  </a>
			  <br clear="all" />
		  </p>
		</div><!--end midbox-->
	</div><!--end mainbox-->

	<div class="mainbox" id="rightbox">
		<div class="midbox">
		  <a href="#" id="sealofexcellence">
		    A Message From Michael Dragoo
		  </a>
		     <a href="{{ url('/commitmenttoexcellence') }}">
		     	<h2 id="boxtitle">
				  Commitment to Excellence
				  </h2>
			  </a>
		  <p id="readmore">
			  We are Committed to creating extraordinary educational and recreational travel experiences for you and your students...
			 <br />
			  <br />
			 <a  class="rightfloat" href="{{ url('/commitmenttoexcellence') }}">
			 <h2>Read More</h2>
			 </a>
			 <br clear="all" />
		 </p>
		</div><!--end midbox-->
	</div><!--end mainbox-->

</div><!--end boxwrap-->

@endsection

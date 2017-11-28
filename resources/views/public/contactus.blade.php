@extends('layouts.public.master', [
	'title' => 'Contact Us | Dragaud Custom Sojourns',
])

@section('content')

<div class="boxwrap">
	<div class="contentbox">

		@include('layouts.public.navtop')
    <div class="mainbox">

      <div class="topbox" id="contactbox">

      <div class="headerbar" id="indexbar">
      <h1 id="bigh1">CONTACT US</h1>

      </div><!--close headerbar-->


      <div class="maintext" id="indextext">
      <div class="contactform">

      <form method= "post" action="http://www.fatcow.com/scripts/formemail.bml">
      <input type="hidden" name="my_email" value="michael@dragaudsojourns.com">
      <input type="hidden" name="thankyou_url" value="http://www.dragaudsojourns.com.html">
      <input type ="hidden" name ="bcc" value="diana.dragaudsojourns@gmail.com">

      <div class="contactwords">
      Name
      <input type="text" class="line" name="Name" id="Name" />
      </div>
      <div class="contactwords">
      City, State
        <input type="text" class="line" name="State" id="State" />
      </div>
      <div class="contactwords">
      Phone
      <input name="phone" class="line" type="text" id="phone" size="17" maxlength="15" />
      </div>
      <div class="contactwords">
      <div class="block"></div>
      Email
         <input type="text" class="line" name="email" id="email" />
      </div>
      <div class="contactnote">
      <textarea name="note" class="line" id="note"></textarea>
      </div>
      <div class="contactwords">
      </div>

      <div class="contactwords">
      <input type="submit" name="Submit" id="Submit" value="Submit" />
      </div>
      </form>

      </div>
      <div class="phonenumber">
         <a href="mailto:	michael@dragaudsojourns.com">
         <h2 style="font-size: 20px">
      Michael@dragaudsojourns.com
         </h2>
         </a>
         Call us at
            <a href="tel:1 (800) 554-7537">
            <h2 style="font-size: 20px">1 (800) 554-7537</h2>
         </a>
      </div>

      </div>


      </div><!--end topbox-->

      <!--start banner--><!--end BANNER-->
      </div><!--end contentbox-->
  </div>
</div>

@endsection

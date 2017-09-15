<div class="fleur" id="topleft"></div>
<div class="fleur" id="topright"></div>

<div class="nav" id="header">
  <ul>
    <li id= @if(Request::url() === url('/') ) "selected" @endif>
      <a href="{{ url('/') }}"}}>
        <h1>Home</h1>
      </a>
    </li>
    <li id= @if(Request::url() === url('/studenttours') ||
                Request::url() === url('/newyork') ||
                Request::url() === url('/greece') ||
                Request::url() === url('/london') )
                 "selected"
             @endif>
      <a href="{{ url('/studenttours') }}">
        <h1>Student Tours</h1>
      </a>
    </li>
    <li id= @if(Request::url() === url('/privatetours') ) "selected" @endif>
      <a href="{{ url('/privatetours') }}">
        <h1>Private Tours</h1>
      </a>
    </li>
    <li id= @if(Request::url() === url('/testimonials') ) "selected" @endif>
      <a href="{{ url('/testimonials') }}">
        <h1>Testimonials</h1>
      </a>
    </li>
    <li id= @if(Request::url() === url('/aboutus') ) "selected" @endif>
      <a href="{{ url('/aboutus') }}">
        <h1>About Us</h1>
      </a>
    </li>
    <li id= @if(Request::url() === url('/contactus') ) "selected" @endif>
      <a href="{{ url('/contactus') }}">
        <h1>Contact Us</h1>
      </a>
    </li>
  </ul>
</div>

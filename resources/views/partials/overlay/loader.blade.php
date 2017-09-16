<div id="{{ $id }}" class="overlay-rounded-wrapper flex-row-between overlay-near-shadow hidden">

  <div class="overlay-loader flex-col-center">
    <svg class="spinner" width="45px" height="45px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
      <circle class="circle" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
    </svg>
  </div>

  <div class="overlay-loader-msg flex-col-center">
    <h3>{{ $header }}</h3>
    <p>{{ $msg }}</p>
  </div>

</div>

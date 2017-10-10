<nav aria-label="...">
  <ul class="pagination pagination-sm">
    <li class="page-item"><a class="page-link" href="/profile/{{ auth()->user()->email }}">1</a></li>
  </ul>
</nav>
<div class="col-xs-12">
  <div class="trips-container">

  </div>
  <div class="trips-default flex-col-start">
    <div class="text-center default-container col-xs-8 col-xs-offset-2">
      <h4>No payments yet.</h4>
      <p>You can either
        <a class="floating-link" href="javascript:;">book a new trip</a> if you haven't already, or
        <a class="floating-link" href="/profile/{{ auth()->user()->email }}">see all trips</a>
         to make a new payment. Once you do all of your payments will appear here.
       </p>
     </div>
  </div>
</div>

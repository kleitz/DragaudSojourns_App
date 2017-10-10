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
      <h4>Welcome, <?php $fullname = explode(" ", auth()->user()->name); echo $fullname[0] ?>.</h4>
      <p>We can't wait to start traveling together! You can update your personal information & travelers,
        <a class="floating-link" href="javascript:;">book a new trip</a>, and
        <a class="floating-link" href="/profile/{{ auth()->user()->email }}/payments">see your payments</a>
         all from right here.
       </p>
     </div>
  </div>
</div>

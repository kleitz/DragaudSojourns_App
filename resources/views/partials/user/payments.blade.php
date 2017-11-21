<?php
  $curUrl = explode("/", Request::url());
  $curPage = $curUrl[count($curUrl) - 1];
  if ($curPage < 1) {
    $curPage = 1;
  }
 ?>
<nav aria-label="...">
  <ul class="pagination pagination-sm">
    @for ($i = 1; $i <= $numPages; $i++)
      @if ($i == 1 || $i == $numPages || ($i > $curPage - 3 && $i < $curPage +3) || $numPages < 8 ||
           ($curPage < 5 && $i < 7 && $numPages > 7) || ($numPages > 6 && $i > $numPages - 6 && $curPage > $numPages - 4))
      <li class="page-item">
        <a class="page-link @if($i == $curPage) page-active @endif" href="/profile/{{ auth()->user()->email }}/payments/{{ $i }}">
          {{ $i }}
          @if ($i == $curPage)
          <span class="sr-only">(current)</span>
          @endif
        </a>
      </li>
      @elseif ($i === $curPage - 3 || $i === $curPage + 3 || ($curPage < 4 && $i < 8) ||  ($curPage > $numPages - 4 && $i > $numPages - 7) )
      <li class="">
        <a class="" style="border: 0px solid"  href="#">...</a>
        </li>
      @endif
    @endfor
  </ul>
</nav>
<div class="col-xs-12 trips-wrapper">
  @if (count($authPayments) > 0)
  <div class="trips-container">
    <table class="table">
      <thead>
        <tr>
          <th>DATE</th>
          <th>RECEIPT</th>
          <th>BOOKING DETAILS</th>
          <th>AMOUNT</th>
          <th>BALANCE</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($authPayments as $payment)
        <?php
          $trip = \App\Trip::where('id', $payment->trip_id)->first();
          $group = \App\Group::where('id', $trip->group_id)->first();
          $traveler = \App\Traveler::where('id', $trip->traveler_id)->first();
        ?>
        <tr>
          <th scope="row">{{ \Carbon\Carbon::parse($payment->created_at)->format('d F Y') }}</th>
          <td><a href="/payments/receipts/{{ $payment->verification }}" target="_blank">{{ $payment->verification }}</a></td>
          <td>#{{ $group->number }} | {{ title_case($traveler->name) }}</td>
          <td>${{ $payment->amount }}</td>
          <td>${{ $payment->balance }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endif
  @if (count($authPayments) < 1)
  <div class="trips-default flex-col-start">
    <div class="text-center default-container col-xs-8 col-xs-offset-2">
      <h4>No payments yet.</h4>
      <p>You can either
        <a class="floating-link" href="javascript:;" @click="showBookingModal" >book a new trip</a> if you haven't already, or
        <a class="floating-link" href="/profile/{{ auth()->user()->email }}">see all trips</a>
         to make a new payment. Once you do all of your payments will appear here.
       </p>
     </div>
  </div>
  @endif
</div>
<div class="full-width flex-row-between page-bottom">
  @if ($numPages > 1)
  <div>
    @if ($curPage > 1)
    <a href="/profile/{{ auth()->user()->email }}/payments/{{ $curPage - 1 }}">Previous page</a>
    @endif
  </div>
  <div>
    @if ($curPage != $numPages)
    <a href="/profile/{{ auth()->user()->email }}/payments/{{ $curPage + 1 }}">Next page</a>
    @endif
  </div>
  @endif
</div>

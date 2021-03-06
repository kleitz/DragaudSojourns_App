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
         <a class="page-link @if($i == $curPage) page-active @endif" href="/profile/{{ auth()->user()->email }}/trips/{{ $i }}">
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
<div class="col-xs-12 trips-wrapper user-main-content">
  @if ($authTrips)
  <div class="trips-container">

    @foreach ($authTrips as $trip)
    <?php
      $group = \App\Group::where('id', $trip->group_id)->first();
      $traveler = \App\Traveler::where('id', $trip->traveler_id)->first();

      $str = explode('/', $group->depart);

      $today = \Carbon\Carbon::now();
      $month = \Carbon\Carbon::now();
      $month->day += 30;
      $depart = \Carbon\Carbon::create($str[2], $str[0], $str[1], 0, 0, 0);
    ?>
    <div class="row">
      @if ($trip->total - $trip->paid == 0 && $trip->active == 1)
      <div class="trip-status trip-paid flex-abs-center">
        <img src="/assets/images/icons/success_check.png" class="inline-success">
        <p>Fully paid</p>
      </div>
      @endif
      @if($month->gte($depart) == true && $trip->total - $trip->paid != 0  && $trip->active == 1)
      <div class="trip-status trip-warn flex-abs-center">
        <div class="inline-warning"><p class="abs-center">!</p></div>
        <p>Payment due soon</p>
      </div>
      @endif
      @if($today->gte($depart) && $trip->total - $trip->paid != 0  && $trip->active == 1)
      <div class="trip-status trip-err flex-abs-center">
        <img src="/assets/images/icons/hazard_tri.png" class="inline-hazard">
        <p>Payment past due!</p>
      </div>
      @endif
      <div class="trip-modal panel panel-secure">
        <div class="row flex-gen expander trip-expander">
          <div class="col-xs-8 flex-col trip-modal-details expander-header">
            <div class="panel-heading flex-row-between grey-panel">
              <div class="flex-row-start">
                <h5 style="margin-bottom: -1px;"><span>{{ $group->number . ": " }}</span> {{ $group->destination }}</h5>
              </div>
              <a href="javascript:;" style="align-self: flex-end;" class="trip-controller" onclick="tripModalExpand(this)">Show details</a>
            </div>
            <div class="panel-body">
              <!-- Minimalized trip details -->
              <div class="trip-details-min">
                <div class="row">
                  <div class="col-xs-5">
                  <h5 style="font-size: 1.4rem;"><span class="font-med">Departs:</span> {{ $group->depart }}</h5>
                  </div>
                  <div class="col-xs-7">
                    <div class="flex-row-start">
                        <h5 style="font-size: 1.4rem; padding-right: 5px;"><span class="font-med">Traveler:</span> </h5>
                        <h5 style="font-size: 1.4rem;">{{ title_case($traveler->name) }}</h5>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Expanded trip details -->
              <div class="trip-details-full hidden">
                <div class="col-xs-4" style="padding: 0">
                  <div class="trip-icon-img full-width">
									  <div class="group-icon-img" style="background: url('/{{ $group->icon }}')"></div>
                  </div>
                  <a href="/{{ $group->itinerary}}" target="_blank">Download itinerary</a>
                </div>
                <div class="col-xs-8">
                  <div class="col-xs-12" style="padding: 0">
                    <p class="trip-modal-seperator"><strong>{{ $group->school }}</strong></p>
                  </div>
                  <div class="row">
                    <div class="col-xs-4">
                      <p>Departs:</p>
                      <p>Returns:</p>
                      <p>Traveler:</p>
                    </div>
                    <div class="col-xs-8">
                      <p><strong>{{ $group->depart }}</strong></p>
                      <p><strong>{{ $group->return }}</strong></p>
                      <p><strong>{{ title_case($traveler->name) }}</strong></p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End expanded trip details -->
            </div>
          </div>
          <div class="col-xs-4 flex-col trip-modal-payments ">
            <div class="panel-heading grey-panel">
              <div class="trip-details-full hidden">
                <h5>Payments</h5>
              </div>
              <div class="trip-details-min">
                <h5 style="margin-bottom: -1px;">
                  @if ($trip->active == 1)
                  <span>Balance:</span> {{ '$' . number_format((float)$trip->total - $trip->paid, 2, '.', '' ) }}
                  @else
                  Cancelled<span>&nbsp;</span>
                  @endif
                </h5>
              </div>
            </div>
            <div class="panel-body">
              <!-- Expanded trip payments -->
              <div class="trip-details-full hidden">
                <p>Travel package: <span style="font-style: italic">{{ title_case($trip->package) }}</span></p>
                <p class="trip-modal-seperator"><strong> ${{ $trip->total }}</strong></p>
                <p>Remaining balance:</p>
                @if ($trip->active == 1)
                <p class="trip-modal-seperator"><strong>
                  {{ '$' . number_format((float)$trip->total - $trip->paid, 2, '.', '' ) }}
                </strong></p>
                @else
                <p class="trip-modal-seperator"><strong>
                  Cancelled
                </strong></p>
                @endif
              </div>
              <!-- End expanded trip payments-->
              <?php
                $tripPayment = new stdClass();
                $tripPayment->trip_id = $trip->id;
                $tripPayment->group_id = $group->id;
                $tripPayment->trip_balance = number_format((float)$trip->total - $trip->paid, 2, '.', '' );
                $tripPayment->traveler = $traveler->name;
                $tripPayment->destination = $group->destination;

                $tripData = json_encode($tripPayment);
               ?>
             @if ($trip->total - $trip->paid == 0 && $trip->active == 1)
               <div style="padding: 8px 0">
                <a href="/trips/receipts/{{ $trip->id }}" target="_blank">Download receipt</a>
              </div>
              @elseif ($trip->total - $trip->paid != 0 && $trip->active == 1)
              <button type="button" name="makepayment" class="ds-button button-gen full-width waves-effect waves-dark" @click="showPaymentModal({{$tripData}})">Make payment</button>
              @elseif ($trip->active == 0)
              <div style="padding: 8px 0">
               <p>--</p>
             </div>
              @endif
            </div>
          </div>
          <div class="col-xs-12 expander-content">
            <div class="panel-body trip-modal-message ">
              <p><strong>Message</strong></p>
              @if ($trip->active == 1)
              <p>{{ $group->message }}</p>
              @else
              <p>This trip has been cancelled. If you have questions
                call us at <a href="javascript:;">1(800) 554-7537</a>,
                email us at <a href="javascript:;">diana.dragaudsojourns@gmail.com </a>
                or visit our <a href="/contactus">contact page</a>.
              </p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

    @endforeach

  </div>
  @endif

  @if (!$authTrips)
  <div class="trips-default flex-col-center">
    <div class="text-center default-container col-xs-8 col-xs-offset-2">
      <h4>Welcome, <?php $fullname = explode(" ", auth()->user()->name); echo $fullname[0] ?>.</h4>
      <p>We can't wait to start traveling together! You can update your personal information & travelers,
        <a class="floating-link" href="javascript:;" @click="showBookingModal">book a new trip</a>, and
        <a class="floating-link" href="/profile/{{ auth()->user()->email }}/payments/1">see your payments</a>
         all from right here.
       </p>
     </div>
  </div>
  @endif
</div>
<div class="full-width flex-row-between page-bottom">
  @if ($numPages > 1)
  <div>
    @if ($curPage > 1)
    <a href="/profile/{{ auth()->user()->email }}/trips/{{ $curPage - 1 }}">Previous page</a>
    @endif
  </div>
  <div>
    @if ($curPage != $numPages)
    <a href="/profile/{{ auth()->user()->email }}/trips/{{ $curPage + 1 }}">Next page</a>
    @endif
  </div>
  @endif
</div>

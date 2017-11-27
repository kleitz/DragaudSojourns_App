<div class="full-card">
  <div class="row" style="margin:0">
    <div class="col-xs-3" style="padding: 0">
      <img src="/{{ $curGroup->icon }}" style="width: 100%; border: 1px solid #ccc">
    </div>
    <div class="col-xs-9">
      <div class="col-xs-12" style="padding: 0">
        <h5 style="margin: 0">
          <span class="font-normal">{{ $curGroup->destination }}</span>
        </h5>
      </div>
      <div class="row">
        <div class="col-xs-5">
          <p class="trip-modal-seperator">{{ $curGroup->school }}</p>
          <p style="margin:0">Departs: <strong>{{ $curGroup->depart }}</strong></p>
          <p style="margin:0">Returns: <strong>{{ $curGroup->return }}</strong></p>
          <a href="/{{ $curGroup->itinerary}}" target="_blank">Download itinerary</a>
        </div>
        <div class="col-xs-7 card-custom message-contain">
          <p style="margin: 10px 0 0 0;"> <strong>Message:</strong> </p>
          <p class="card-custom custom-message">{{ $curGroup->message }} </p>
        </div>
      </div>
  </div>
</div>
</div>

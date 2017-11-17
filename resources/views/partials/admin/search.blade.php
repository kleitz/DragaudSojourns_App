<div class="admin-search-container flex-col-end">
  <form class="flex-row-between" method="GET" action="/admin/{{ $authAdmin }}/{{ $curSection }}/1" enctype="multipart/form-data" role="search">
      @if ($curSection == 'payments')
      <div class="flex-row-between" style="width: 450px; align-items: center">
        <label class="text-center text-nowrap search-datepicker-label" style="margin-left: 5px;">Start date</label>
        <div class="form-group" style="padding: 0;">
          <input type="text" name="datefrom" class="form-control search-datepicker" id="payment-begin" value="{{ $dateFrom }}">
        </div>
        <label class="text-center text-nowrap search-datepicker-label">End date</label>
        <div class="form-group" style="padding: 0;">
          <input type="text" name="dateto" class="form-control search-datepicker" id="payment-end" value="{{ $dateTo }}">
        </div>
      </div>
      <div style='margin-top: -90px'>
      @endif
      <div class="form-inline">
        <div class="form-group mx-sm-3">
          <label for="search" class="sr-only">Search</label>
          <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ $searched }}">
          <i class="fa fa-search" aria-hidden="true"></i>
        </div>
        <button type="submit" class="ds-button button-gen">Search now</button>
      </div>
        @if ($curSection == 'payments')
      </div>
      @endif
  </form>
</div>
@if ($curSection == 'payments')
<script type="text/javascript">
let dateFrom = {!! json_encode($dateFrom) !!};
let dateTo = {!! json_encode($dateTo) !!};
$('#payment-begin').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome'
});
$('#payment-begin').val(dateFrom);
$('#payment-end').datepicker({
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome'
  });
  $('#payment-end').val(dateTo);
</script>
@endif

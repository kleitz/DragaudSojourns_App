@extends('layouts.admin.master', [
	'title' => 'All Payments | Dragaud Custom Sojourns',
])

@section('content')
<div id="acccount-show-app" class="container admin-container">
<!-- PAYMENTS SEARCH RESULTS -->
<div class="col-xs-12 relative" style="z-index: 20">
  <div class="admin-floating-panel z-depth-2">
    <div class="flex-row-between">
      <div onclick="window.location='/admin/{{ $authAdmin }}/payments/1'" class="pointer">
        <h3 class="admin-section-header" >All payments</h3>
      </div>
    <!-- SEARCH BAR -->
      <div class="admin-search-container flex-col-end">
        <form class="form-inline flex-row-start" method="GET" action="/admin/{{ $authAdmin }}/payments/1" enctype="multipart/form-data" role="search">
          <div class="form-payment mx-sm-3">
            <label for="search" class="sr-only">Search</label>
            <input type="text" class="form-control" name="search" placeholder="Search...">
            <i class="fa fa-search" aria-hidden="true"></i>
          </div>
          <button type="submit" class="ds-button button-gen">Search now</button>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <?php
          $curUrl = explode("/", Request::url());
          $curPage = $curUrl[count($curUrl) - 1];
          if ($curPage < 1) {
            $curPage = 1;
          }
          $search = '';
          if (isset($_GET['search'])){
            $search = '?search=' . $_GET['search'];
          }
         ?>
        <nav aria-label="...">
          <ul class="pagination pagination-show">
            @for ($i = 1; $i <= $paymentPages; $i++)
              @if ($i != $curPage)
              <li class="page-item">
                <a class="page-link" href="/admin/{{ $authAdmin }}/payments/{{ $i . $search}}">{{ $i }}</a>
              </li>
              @else
              <li class="page-item">
                <a class="page-link page-active"  href="/admin/{{ $authAdmin }}/payments/{{ $i . $search }}">{{ $i }}<span class="sr-only">(current)</span></a>
              </li>
              @endif
            @endfor
          </ul>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 admin-show-table">
        <table class="table">
          <thead style="border-bottom: 10px solid white;">
            <tr>
              <th scope="col">Payment Id</th>
              <th scope="col">User Name</th>
              <th scope="col">Traveler</th>
              <th scope="col">Group #</th>
              <th scope="col">Amount</th>
              <th scope="col">Fee</th>
              <th scope="col">Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach($authPayments as $payment )
            <?php
              $trip = \App\Trip::where('id', $payment->trip_id)->first();
              $traveler = \App\Traveler::where('id', $trip->traveler_id)->first();
              $group = \App\Group::where('id', $trip->group_id)->first();
              $user = \App\User::where('id', $payment->user_id)->first();
             ?>
            <tr>
              <td class="show-td-l">
                <a href="/payments/receipts/{{ $payment->verification }}" target="_blank">{{ $payment->verification }}</a>
              </td>
              <td class="show-account-user flex-row-start">
                <a href="javascript:;">{{ $user->name }}</a>
                <div class="relative admin-helper-modal hidden">
                  <div class="admin-helper">
                    <p>Account #: <strong>{{ $user->created_at->timestamp }}</strong> </p>
                    <p>Email: <strong>{{ $user->email }}</strong> </p>
                    <p>Home: <strong>{{ $user->home }}</strong></p>
                    <p>Cell: <strong>{{ $user->cell }}</strong></p>
                    <div class="flex-row-start">
                      <p>Address: </p>
                      <p><strong>{{ $user->street }}<br/>{{ $user->zip}}</strong></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="show-td-l">{{ $traveler->name }}</td>
              <td class="show-td-l">
                <a href="/admin/{{ $authAdmin }}/group/{{ $group->number }}">{{$group->number}}</a>
              </td>
              <td class="show-td-l">${{ $payment->amount }}</td>
              <td class="show-td-l">${{ $payment->fee }}</td>
              <td class="show-td-l">{{ $payment->created_at->format('m/d/y') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="full-width flex-row-between page-bottom">
      @if ($paymentPages > 1)
      <div>
        @if ($curPage > 1)
        <a href="/admin/{{ $authAdmin }}/payments/{{ $curPage - 1 . $search}}">Previous page</a>
        @endif
      </div>
      <div>
        @if ($curPage != $paymentPages)
        <a href="/admin/{{ $authAdmin }}/payments/{{ $curPage + 1 . $search}}">Next page</a>
        @endif
      </div>
      @endif
    </div>
  </div>
</div>
<!-- END paymentS SEARCH  -->
</div>
@endsection

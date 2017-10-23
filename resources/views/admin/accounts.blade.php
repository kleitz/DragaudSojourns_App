@extends('layouts.admin.master', [
	'title' => 'All Accounts | Dragaud Custom Sojourns',
])

@section('content')
<div id="acccount-show-app" class="container admin-container">
<!-- ACCOUNTS SEARCH RESULTS -->
<div class="col-xs-10 relative" style="z-index: 20">
  <div class="admin-floating-panel z-depth-2">
    <div class="flex-row-between">
      <div onclick="window.location='/admin/{{ $authAdmin }}/accounts/1'" class="pointer">
        <h3 class="admin-section-header" >All accounts</h3>
      </div>
    <!-- SEARCH BAR -->
      <div class="admin-search-container flex-col-end">
        <form class="form-inline flex-row-start" method="GET" action="/admin/{{ $authAdmin }}/accounts/1" enctype="multipart/form-data" role="search">
          <div class="form-account mx-sm-3">
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
            @for ($i = 1; $i <= $accountPages; $i++)
              @if ($i != $curPage)
              <li class="page-item">
                <a class="page-link" href="/admin/{{ $authAdmin }}/accounts/{{ $i . $search}}">{{ $i }}</a>
              </li>
              @else
              <li class="page-item">
                <a class="page-link page-active"  href="/admin/{{ $authAdmin }}/accounts/{{ $i . $search }}">{{ $i }}<span class="sr-only">(current)</span></a>
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
              <th scope="col">Account #</th>
              <th scope="col">Full Name</th>
              <th scope="col">Travelers</th>
              <th scope="col">Created</th>
            </tr>
          </thead>
          <tbody>
            @foreach($authAccounts as $account )
            <?php
              $travelers = \App\Traveler::where('user_id', $account->id)->get();
              $number = $account->created_at->timestamp;
             ?>
            <tr>
              <td class="show-account-user flex-row-start">
                <a href="javascript:;">{{ $number }}</a>
                <div class="relative admin-helper-modal hidden">
                  <div class="admin-helper">
                    <p>Email: <strong>{{ $account->email }}</strong> </p>
                    <p>Home: <strong>{{ $account->home }}</strong></p>
                    <p>Cell: <strong>{{ $account->cell }}</strong></p>
                    <div class="flex-row-start">
                      <p>Address: </p>
                      <p><strong>{{ $account->street }}<br/>{{ $account->zip}}</strong></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="show-td-l">{{ $account->name }}</td>
              <td >
                <div class="material-input-group" style="padding: 0 50px 0 0;">
                  <select class="custom-select form-control material-input" name="traveler">
                    @foreach($travelers as $traveler)
                    <option value="{{$traveler->name}}" > {{ $traveler->name }} </option>
                    @endforeach
                  </select>
                </div>
              </td>
              <td class="show-td-l">{{ $account->created_at->format('m/d/y') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="full-width flex-row-between page-bottom">
      @if ($accountPages > 1)
      <div>
        @if ($curPage > 1)
        <a href="/admin/{{ $authAdmin }}/accounts/{{ $curPage - 1 . $search}}">Previous page</a>
        @endif
      </div>
      <div>
        @if ($curPage != $accountPages)
        <a href="/admin/{{ $authAdmin }}/accounts/{{ $curPage + 1 . $search}}">Next page</a>
        @endif
      </div>
      @endif
    </div>
  </div>
</div>
<!-- END ACCOUNTS SEARCH  -->
</div>
@endsection

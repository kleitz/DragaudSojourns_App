@extends('layouts.admin.master', [
	'title' => 'All Groups | Dragaud Custom Sojourns',
])

@section('content')
<div id="group-show-app" class="container admin-container">
<!-- GROUPS SEARCH RESULTS -->
<div class="col-xs-12 relative" style="z-index: 20">
  <div class="admin-floating-panel z-depth-2">
    <div class="flex-row-between">
      <div onclick="window.location='/admin/{{ $authAdmin }}/groups/1'" class="pointer">
        <h3 class="admin-section-header" >All Groups</h3>
      </div>
    <!-- SEARCH BAR -->
      <div class="admin-search-container flex-col-end">
        <form class="form-inline" method="GET" action="/admin/{{ $authAdmin }}/groups/1" enctype="multipart/form-data" role="search">
          <div class="form-group mx-sm-3">
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
            @for ($i = 1; $i <= $groupPages; $i++)
              @if ($i != $curPage)
              <li class="page-item">
                <a class="page-link" href="/admin/{{ $authAdmin }}/groups/{{ $i . $search}}">{{ $i }}</a>
              </li>
              @else
              <li class="page-item">
                <a class="page-link page-active"  href="/admin/{{ $authAdmin }}/groups/{{ $i . $search }}">{{ $i }}<span class="sr-only">(current)</span></a>
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
          <thead>
            <tr>
              <th scope="col">Number</th>
              <th scope="col">Destination</th>
              <th scope="col">Dates</th>
              <th scope="col">School</th>
              <th scope="col">Progress</th>
            </tr>
          </thead>
          <tbody>
            @foreach($authGroups as $group )
            <?php
              $trips = $group->trips()->get();
              $len = count($trips);
              $total = 0;
              $paid = 0;
              if ($len > 0) {
                for ($i = 0; $i < $len; $i++ ) {
                  $total += $trips[$i]->total;
                  $paid += $trips[$i]->paid;
                }
              } else {
                $total = 1;
              }

              $progress = floor($paid / $total * 100);
              $tripClass = 'progress-good';
              if ($progress < 60 && $progress > 30) {
                $tripClass = 'progress-safe';
              } else if ($progress < 30) {
                $tripClass = 'progress-warning';
              }

              $str = explode('/', $group->depart);
              $today = \Carbon\Carbon::now();
              $depart = \Carbon\Carbon::create($str[2], $str[0], $str[1], 0, 0, 0);

              if ($progress < 100 && $today->gte($depart))
                $tripClass = 'progress-hazard';
             ?>
            <tr>
              <td scope="row">
                <div class="flex-abs-center group-show-icon relative">
                  @if ($tripClass == 'progress-hazard')
                  <div class="group-hazard-icon absolute">
                    <small class="abs-center">!</small>
                  </div>
                  @endif
                  <div class="show-icon-container">
                    <img src="/{{ $group->icon }}" alt="">
                  </div>
                  <a href="/admin/{{ $authAdmin }}/group/{{ $group->number }}">{{$group->number}}</a>
                </div>
              </td>
              <td class="{{ $tripClass }}" >{{ $group->destination }}</td>
              <td class="{{ $tripClass }}" >{{ $group->depart }} - {{ $group->return }}</td>
              <td class="{{ $tripClass }}" >{{ $group->school }}</td>
               <td style="width: 250px">
                 <div class="group-progress flex-abs-center">
                   <div class="progress-bar">
                     <div class="progress-bar-bg"></div>
                     <div class="progress-bar-fg {{ $tripClass }}"></div>
                   </div>
                   <p class="progress-bar-stat">{{ $progress . '%' }}</p>
                 </div>
               </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="full-width flex-row-between page-bottom">
      @if ($groupPages > 1)
      <div>
        @if ($curPage > 1)
        <a href="/admin/{{ $authAdmin }}/groups/{{ $curPage - 1 . $search}}">Previous page</a>
        @endif
      </div>
      <div>
        @if ($curPage != $groupPages)
        <a href="/admin/{{ $authAdmin }}/groups/{{ $curPage + 1 . $search}}">Next page</a>
        @endif
      </div>
      @endif
    </div>
  </div>
</div>
<!-- END GROUPS SEARCH  -->
</div>
@endsection

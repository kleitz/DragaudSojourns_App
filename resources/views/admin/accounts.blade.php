@extends('layouts.admin.master', [
	'title' => 'All Accounts | Dragaud Custom Sojourns',
])

@section('content')
<?php
	$curUrl = explode("/", Request::url());
	$curPage = $curUrl[count($curUrl) - 1];
	$curSection = $curUrl[count($curUrl) - 2];
	if ($curPage < 1) {
		$curPage = 1;
	}
	$search = '';
	if (isset($_GET['search'])){
		$search = '?search=' . $_GET['search'];
	}
 ?>
<div id="acccount-show-app" class="container admin-container">
<!-- ACCOUNTS SEARCH RESULTS -->
<div class="col-xs-10 relative" style="z-index: 20">
  <div class="admin-floating-panel z-depth-2">
    <div class="flex-row-between">
      <div onclick="window.location='/admin/{{ $authAdmin }}/accounts/1'" class="pointer">
        <h3 class="admin-section-header" >All accounts</h3>
      </div>
    	<!-- SEARCH BAR -->
      @include('partials.admin.search')
    </div>
    <div class="row">
      <div class="col-xs-12">
				@include('partials.admin.pagination')
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
              $travelers = \App\Traveler::where('user_id', $account->id)->get()->groupBy('relationship');
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
                    @foreach($travelers as $relation)
										<?php
											$label = $relation[0]->relationship;
											if ($relation[0]->relationship == 'Myself') $label = 'Account owner';
										?>
										<optgroup label="{{ $label }}">
											@for ($i = 0; $i < count($relation); $i++)
		                    <option value="{{$relation[$i]->name}}" >
														{{ $relation[$i]->name }}
												</option>
											@endfor
											</optgroup>
                    @endforeach
										@if (count($travelers) == 0 )
										<option value="no-traveler" > None </option>
										@endif
                  </select>
                </div>
              </td>
              <td class="show-td-l">{{ $account->created_at->format('m/d/y') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
				@if (count($authAccounts) == 0)
					@include('partials.admin.noresults')
				@endif
      </div>
    </div>
  @include('partials.admin.pagebottom')
  </div>
</div>
<!-- END ACCOUNTS SEARCH  -->
</div>
@endsection

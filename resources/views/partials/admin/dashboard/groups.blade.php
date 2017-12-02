<div class="admin-floating-panel z-depth-2">
  <div onclick="window.location='/admin/{{ $authAdmin }}/groups/1'" class="pointer">
    <h4 class="admin-section-subheader" style="margin-bottom: 0">Recent groups</h4>
  </div>
  <div class="row">
    <div class="col-xs-12 admin-show-table" style="min-height: auto;">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Number</th>
            <th scope="col">Details</th>
            <th scope="col">Progress</th>
          </tr>
        </thead>
        <tbody>
          @foreach($recentGroups as $group )
          <?php
            $trips = $group->trips()->get();
            $len = count($trips);
            $total = 0;
            $paid = 0;
            if ($len > 0) {
              for ($i = 0; $i < $len; $i++ ) {
                if ($trips[$i]->active == 1){
                  $total += $trips[$i]->total;
                  $paid += $trips[$i]->paid;
                }
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
                  <div class="group-icon-img" style="background: url('/{{ $group->icon }}')"></div>
                </div>
                <a href="/admin/{{ $authAdmin }}/group/{{ $group->number }}">{{$group->number}}</a>
              </div>
            </td>
            <td class="{{ $tripClass }}" >{{ $group->depart }}: {{ $group->destination }}</td>
             <td style="width: 200px">
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
      <a href="/admin/{{ $authAdmin }}/groups/1" class="admin-feature-link"><span>+</span> See all groups</a>
    </div>
  </div>

</div>

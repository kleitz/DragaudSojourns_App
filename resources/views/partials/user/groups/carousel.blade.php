<div class="card-carousel">
 <nav class="card-carousel-reel">
   @foreach ($authGroups as $group)
      <a href="/profile/{{ auth()->user()->email }}/groups/{{ $group->number }}">
        <div class="hz-card @if ($group->number == $curPage) card-active @endif">
          <div class="card-label">{{ $group->number }}</div>
          <div class="card-content">{{ $group->destination }}</div>
        </div>
      </a>
   @endforeach
 </nav>
</div>
<!-- Group card carousel controls -->
<div class="flex-row-between carousel-controls">
  <div style="z-index: 3">
    <div  class="carousel-button left  hidden">
      <div class="carousel-shield left"></div>
      <button type="button" class="btn-floating btn-large waves-effect waves-dark white">
        <i class="material-icons">chevron_left</i>
      </button>
    </div>
  </div>
  <div style="z-index: 3" >
    <div class="carousel-button right  hidden" >
      <div class="carousel-shield right"></div>
      <button type="button" class="btn-floating btn-large waves-effect waves-dark white">
        <i class="material-icons">chevron_right</i>
      </button>
    </div>
  </div>
</div>

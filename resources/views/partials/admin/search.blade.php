<div class="admin-search-container flex-col-end">
  <form class="form-inline" method="GET" action="/admin/{{ $authAdmin }}/{{ $curSection }}/1" enctype="multipart/form-data" role="search">
    <div class="form-group mx-sm-3">
      <label for="search" class="sr-only">Search</label>
      <input type="text" class="form-control" name="search" placeholder="Search...">
      <i class="fa fa-search" aria-hidden="true"></i>
    </div>
    <button type="submit" class="ds-button button-gen">Search now</button>
  </form>
</div>

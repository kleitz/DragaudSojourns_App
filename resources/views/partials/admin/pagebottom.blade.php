<div class="full-width flex-row-between page-bottom">
  @if ($numPages > 1)
  <div>
    @if ($curPage > 1)
    <a href="/admin/{{ $authAdmin }}/{{ $curSection }}/{{ $curPage - 1 . $search}}">Previous page</a>
    @endif
  </div>
  <div>
    @if ($curPage != $numPages)
    <a href="/admin/{{ $authAdmin }}/{{ $curSection }}/{{ $curPage + 1 . $search}}">Next page</a>
    @endif
  </div>
  @endif
</div>

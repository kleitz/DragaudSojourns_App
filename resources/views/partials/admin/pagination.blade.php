<nav aria-label="...">
  <ul class="pagination pagination-show">
    @for ($i = 1; $i <= $numPages; $i++)
      @if ($i == 1 || $i == $numPages || ($i > $curPage - 3 && $i < $curPage +3) || $numPages < 8 ||
           ($curPage < 5 && $i < 7 && $numPages > 7) || ($numPages > 6 && $i > $numPages - 6 && $curPage > $numPages - 4)
           )
        @if ($i != $curPage)
        <li class="page-item">
          <a class="page-link" href="/admin/{{ $authAdmin }}/{{ $curSection }}/{{ $i . $search . $dateFromSearch . $dateToSearch }}">{{ $i }}</a>
        </li>
        @else
        <li class="page-item">
          <a class="page-link page-active admpage-active"  href="/admin/{{ $authAdmin }}/{{ $curSection }}/{{ $i . $search . $dateFromSearch . $dateToSearch }}">
            {{ $i }}<span class="sr-only">(current)</span></a>
        </li>
        @endif
      @elseif ($i === $curPage - 3 || $i === $curPage + 3 || ($curPage < 4 && $i < 8) ||  ($curPage > $numPages - 4 && $i > $numPages - 7) )
        <li class="page-item">
          <a class="page-link page-active"  href="#">...</a>
        </li>
      @endif
    @endfor
  </ul>
</nav>

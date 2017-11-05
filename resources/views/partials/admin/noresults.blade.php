<div class="null-results-container flex-col-center">
  <div class="null-results z-depth-1 border-panel-light">
    @if (isset($_GET['search']))
    <h5>Your search <strong style="font-style: italic">{{ $_GET['search'] }}</strong> did not return any results</h5>
    @endif
  </div>
  <div class="null-results-suggestions">
    <h4 style="font-weight: 100">Search tips:</h4>
    <ul>
      <li>Check your spelling and try again</li>
      <li>Try searching within other columns</li>
      <li>Try a similar but different search term</li>
    </ul>
  </div>
</div>

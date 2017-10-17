<nav>
  <ul>
    <li>
      <a href="#" class="flex-row-start">
        <div class="admin-nav-icon">
          @include('partials.vector.dashboard')
        </div>
        <p class="flex-col-center">
        Dashboard
      </p>
      </a>
    </li>
    <li>
      <a href="#" class="flex-row-start">
        <div class="admin-nav-icon">
          @include('partials.vector.groups')
        </div>
        <p class="flex-col-center">
        Groups
      </p>
      </a>
    </li>
    <li>
      <a href="#" class="flex-row-start">
        <div class="admin-nav-icon">
          @include('partials.vector.accounts')
        </div>
        <p class="flex-col-center">
        Accounts
      </p>
      </a>
    </li>
    <li>
      <a href="#" class="flex-row-start">
        <div class="admin-nav-icon">
          @include('partials.vector.payments')
        </div>
        <p class="flex-col-center">
        Payments
      </p>
      </a>
    </li>
    <li>
      <a href="#" class="flex-row-start">
        <div class="admin-nav-icon">
          @include('partials.vector.system')
        </div>
        <p class="flex-col-center">
        System
      </p>
      </a>
    </li>
  </ul>
</nav>
<button type="button" name="button" class="ds-button button-gen full-width">+ Create a new group</button>

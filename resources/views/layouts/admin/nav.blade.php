<nav>
  <ul>
    <li>
      <a href="/admin/{{ auth('admin')->user()->email }}/dashboard" class="flex-row-start">
        <div class="admin-nav-icon">
          @include('partials.vector.dashboard')
        </div>
        @if (Request::is('*/dashboard'))
        <p class="flex-col-center admin-nav-active">Dashboard</p>
        @else
        <p class="flex-col-center">Dashboard</p>
        @endif
      </a>
    </li>
    <li>
      <a href="/admin/{{ auth('admin')->user()->email }}/groups/1" class="flex-row-start">
        <div class="admin-nav-icon">
          @include('partials.vector.groups')
        </div>
        @if (Request::is('*/groups/*'))
        <p class="flex-col-center admin-nav-active">Groups</p>
        @else
        <p class="flex-col-center">Groups</p>
        @endif
      </a>
    </li>
    <li>
      <a href="/admin/{{ auth('admin')->user()->email }}/accounts/1" class="flex-row-start">
        <div class="admin-nav-icon">
          @include('partials.vector.accounts')
        </div>
        @if (Request::is('*/accounts/*'))
        <p class="flex-col-center admin-nav-active">Accounts</p>
        @else
        <p class="flex-col-center">Accounts</p>
        @endif
      </a>
    </li>
    <li>
      <a href="/admin/{{ auth('admin')->user()->email }}/payments/1" class="flex-row-start">
        <div class="admin-nav-icon">
          @include('partials.vector.payments')
        </div>
        @if (Request::is('*/payments/*'))
        <p class="flex-col-center admin-nav-active">Payments</p>
        @else
        <p class="flex-col-center">Payments</p>
        @endif
      </a>
    </li>
    <li>
      <a href="/admin/{{ auth('admin')->user()->email }}/settings/" class="flex-row-start">
        <div class="admin-nav-icon">
          @include('partials.vector.system')
        </div>
        @if (Request::is('*/settings/*'))
        <p class="flex-col-center admin-nav-active">Settings</p>
        @else
        <p class="flex-col-center">Settings</p>
        @endif
      </a>
    </li>
  </ul>
</nav>
@if ( auth('admin')->user()->level == 'System Administrator')
<button type="button" name="button" class="ds-button button-gen " onclick="window.location='/admin/{{ auth('admin')->user()->email }}/new/group'">+ Create new group</button>
@endif

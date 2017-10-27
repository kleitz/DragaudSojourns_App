<nav>
  <ul>
    <li>
      <a href="/admin/jjvannatta88/dashboard" class="flex-row-start">
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
      <a href="/admin/jjvannatta88/groups/1" class="flex-row-start">
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
      <a href="/admin/jjvannatta88/accounts/1" class="flex-row-start">
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
      <a href="/admin/jjvannatta88/payments/1" class="flex-row-start">
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
      <a href="#" class="flex-row-start">
        <div class="admin-nav-icon">
          @include('partials.vector.system')
        </div>
        @if (Request::is('*/system/*'))
        <p class="flex-col-center admin-nav-active">System</p>
        @else
        <p class="flex-col-center">System</p>
        @endif
      </a>
    </li>
  </ul>
</nav>
<button type="button" name="button" class="ds-button button-gen" onclick="window.location='/admin/jjvannatta88/group/new'">+ Create new group</button>

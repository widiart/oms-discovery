<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header justify-content-center">
    <a href="#" class="b-brand text-primary">
      <h3 class="mb-0 text-primary">
        OMS DISCOVERY
      </h3>
    </a>
    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">
        @role('admin')
          <li class="pc-item">
            <a href="{{ route('dashboard.index') }}" class="pc-link">
              <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
              <span class="pc-mtext">Dashboard</span>
            </a>
          </li>
        @endrole
        <li class="pc-item">
          <a href="{{ route('product.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-box"></i></span>
            <span class="pc-mtext">Product Management</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('customer.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-users"></i></span>
            <span class="pc-mtext">Customer Management</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('order.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-shopping-cart"></i></span>
            <span class="pc-mtext">Order Management</span>
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>
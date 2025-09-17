<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('dashboard') }}" class="app-brand-link">
      <span class="app-brand-text fw-bold">VentasFix</span>
    </a>
  </div>

  <ul class="menu-inner py-1">
    <li class="menu-item">
      <a href="{{ route('dashboard') }}" class="menu-link">
        <i class="menu-icon ti ti-home"></i>
        <div>Dashboard</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="{{ route('users.index') }}" class="menu-link">
        <i class="menu-icon ti ti-users"></i>
        <div>Usuarios</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="{{ route('products.index') }}" class="menu-link">
        <i class="menu-icon ti ti-package"></i>
        <div>Productos</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="{{ route('clients.index') }}" class="menu-link">
        <i class="menu-icon ti ti-user"></i>
        <div>Clientes</div>
      </a>
    </li>
  </ul>
</aside>

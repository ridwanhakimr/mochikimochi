<div class="sidebar p-3 text-white bg-dark" style="min-height: 100vh;">
  <h4 class="text-white mb-4">
    <i class="bi bi-person-circle me-2"></i>Admin
  </h4>

  <a href="{{ route('admin.dashboard') }}" class="text-white d-block py-2">
    <i class="bi bi-speedometer2 me-2"></i>Dashboard
  </a>

  <div class="dropdown">
    <a class="text-white d-block py-2 dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
      <i class="bi bi-database-fill-gear me-2"></i>Data Master
    </a>
    <ul class="dropdown-menu dropdown-menu-dark">
      <li><a class="dropdown-item" href="{{ route('moci.index') }}">Produk</a></li>
    </ul>
  </div>
</div>
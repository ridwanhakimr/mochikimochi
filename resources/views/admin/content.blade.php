@extends('admin.app')

@section('content')
<h3 class="mb-4">Dashboard</h3>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-box-seam fs-1"></i>
                </div>
                <div>
                    <h5 class="card-title mb-1">Produk</h5>
                    <p class="card-text mb-0">12 Produk Terdaftar</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
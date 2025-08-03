@extends('admin.app')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        {{-- Kartu Statistik Total Produk --}}
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            {{-- Tampilkan angka total produk di sini --}}
                            <div class="fs-2 fw-bold">{{ $totalProduk }}</div>
                            <div>Total Produk Terdaftar</div>
                        </div>
                        <div class="fs-1">
                            {{-- Ikon dari Bootstrap Icons --}}
                            <i class="bi bi-box-seam"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
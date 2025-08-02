@extends('admin.app')

@section('content')
<div class="container py-4">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Data Moci</h5>
      <div>
        <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
          <i class="bi bi-plus-circle"></i> Tambah Produk
        </button>
      </div>
    </div>

    <!-- Search bar (initially hidden) -->
    <div class="p-3 d-none hiddensearch">
      <input type="text" class="form-control global-search" placeholder="Cari sesuatu..." />
    </div>

    <div class="table-responsive">
      <table id="datatable" class="table table-striped mb-0">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Gambar</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

@include('table.from-moci')
@endsection


@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function() {
    $('#datatable').DataTable({
      ajax: '/moci/data',
      columns: [{
          data: 'nama'
        },
        {
          data: 'gambar',
          render: function(data) {
            return `<img src="/storage/${data}" width="50"/>`;
          }
        },
        {
          data: 'harga',
          render: function(data) {
            return Number(data).toLocaleString('id-ID'); // format sesuai lokal Indonesia
          }
        },
        {
          data: 'stok'
        },
        {
          data: 'deskripsi'
        },
        {
          data: null,
          render: function(data, type, row) {
            return `
   <button class="btn btn-sm btn-warning btn-edit" data-id="${row.id}">Edit</button>
  <button class="btn btn-sm btn-danger" data-id="${row.id}">Hapus</button>
`;
          }
        }
      ]
    });
    $('#formTambah').submit(function(e) {
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: '/moci/store',
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
          $('#datatable').DataTable().ajax.reload();
          $('#formTambah')[0].reset();
          alert('Produk berhasil ditambahkan!');
        }
      });
    });
    $(document).on('click', '.btn-edit', function() {
      let id = $(this).data('id');

      $.get(`/moci/${id}`, function(res) {
        $('#edit-id').val(res.id);
        $('#edit-nama').val(res.nama);
        $('#edit-harga').val(res.harga);
        $('#edit-stok').val(res.stok);
        $('#edit-deskripsi').val(res.deskripsi);
        $('#modalEdit').modal('show');
      });
    });

    // FORM EDIT disubmit
    $('#formEdit').submit(function(e) {
      e.preventDefault();
      let id = $('#edit-id').val();
      let formData = new FormData(this);
      formData.append('_method', 'POST'); // spoof method PUT

      $.ajax({
        url: `/moci/${id}`,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function() {
          $('#modalEdit').modal('hide');
          $('#datatable').DataTable().ajax.reload();
          alert('Produk berhasil diupdate!');
        },
        error: function(xhr) {
          alert('Gagal update produk!');
          console.log(xhr.responseText);
        }
      });
    });

    // Hapus produk
    $(document).on('click', '.btn-danger', function() {
      let id = $(this).data('id');
      if (confirm('Yakin hapus?')) {
        $.ajax({
          url: `/moci/${id}`,
          type: 'DELETE',
          data: {
            _token: '{{ csrf_token() }}'
          },
          success: function() {
            $('#datatable').DataTable().ajax.reload();
          }
        });
      }
    });
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

  });
</script>
@endpush
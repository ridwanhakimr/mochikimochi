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

    <div class="table-responsive">
      <table id="datatable" class="table table-striped mb-0">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Gambar</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Deskripsi</th>
            <th>Terakhir diupdate oleh</th>
            <th>dibuat padaJ</th>
            <th>update pada</th> <th>Aksi</th>
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
      ajax: '/admin/moci/data',
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
        { // Tambahkan kolom baru
          data: 'updated_by.name',
          defaultContent: 'N/A' // Tampilkan jika tidak ada data admin
        },
        {
          data: 'created_at',
          render: function(data) {
            return new Date(data).toLocaleDateString('id-ID'); // format tanggal sesuai lokal Indonesia
          }
        },
        {
          data: 'updated_at',
          render: function(data) {
            return new Date(data).toLocaleDateString('id-ID'); // format tanggal sesuai lokal Indonesia
          }
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
        url: '/admin/moci/store',
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

      $.get(`/admin/moci/${id}`, function(res) {
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
      
      // --- TAMBAHKAN BARIS INI ---
      formData.append('_method', 'PUT');
      // -----------------------------

      $.ajax({
        // Pastikan tipe request adalah 'POST'
        // Laravel akan secara otomatis mendeteksinya sebagai 'PUT' karena baris di atas
        type: 'POST',
        url: `/admin/moci/${id}`,
        data: formData,
        contentType: false,
        processData: false,
        success: function() {
          $('#modalEdit').modal('hide');
          $('#datatable').DataTable().ajax.reload();
          alert('Produk berhasil diupdate!');
        },
        error: function(xhr) {
          // Tampilkan pesan error yang lebih detail di console
          console.error('Terjadi kesalahan:', xhr.responseText);
          
          // Coba parsing JSON untuk error validasi
          try {
            let errors = JSON.parse(xhr.responseText).errors;
            let errorMsg = "Gagal update produk:\n";
            $.each(errors, function(key, value) {
              errorMsg += "- " + value[0] + "\n";
            });
            alert(errorMsg);
          } catch (e) {
            alert('Gagal update produk! Silakan cek console browser untuk detailnya.');
          }
        }
      });
    });

    // Hapus produk
    $(document).on('click', '.btn-danger', function() {
      let id = $(this).data('id');
      if (confirm('Yakin hapus?')) {
        $.ajax({
          url: `/admin/moci/${id}`,
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
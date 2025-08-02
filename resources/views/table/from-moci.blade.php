        <!-- Modal Tambah Produk -->
        <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <form id="formTambah" enctype="multipart/form-data">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah Produk</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-2">
                    <label>Nama Produk</label>
                    <input type="text" name="nama" class="form-control" required />
                  </div>
                  <div class="mb-2">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control" required />
                  </div>
                  <div class="mb-2">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" required />
                  </div>
                  <div class="mb-2">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" required />
                  </div>
                  <div class="mb-2">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control"></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Modal Edit Produk -->
        <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <form id="formEdit" enctype="multipart/form-data">
              <input type="hidden" name="id" id="edit-id">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Produk</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-2">
                    <label>Nama Produk</label>
                    <input type="text" name="nama" id="edit-nama" class="form-control" required />
                  </div>
                  <div class="mb-2">
                    <label>Gambar Baru (Opsional)</label>
                    <input type="file" name="gambar" class="form-control" />
                  </div>
                  <div class="mb-2">
                    <label>Harga</label>
                    <input type="number" name="harga" id="edit-harga" class="form-control" required />
                  </div>
                  <div class="mb-2">
                    <label>Stok</label>
                    <input type="number" name="stok" id="edit-stok" class="form-control" required />
                  </div>
                  <div class="mb-2">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" id="edit-deskripsi" class="form-control"></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
            </form>
          </div>
        </div>
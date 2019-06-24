<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Penyewa Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('clients.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">NIK</label>
                        <input type="text" name="nik" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nama Penyewa</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option disabled selected>- Pilih Salah Satu -</option>
                            <option value="pria" {{ (old("type") == 'pria' ? "selected":"") }}>Pria</option>
                            <option value="wanita" {{ (old("type") == 'wanita' ? "selected":"") }}>Wanita</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nomor HP</label>
                        <input type="number" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="address">Alamat</label>
                      <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                    </div>
                    <button type="button" class="btn btn-default float-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary float-right">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
<form action="" method="POST" id="editForm" enctype="multipart/form-data">
    @method('put')
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">

            <input type="hidden" value="{{ $mahasiswa->id }}" id="id_data" name="id">

            <div class="form-group">
                <label for="nim">Nim :</label>
                <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM" value="{{ $mahasiswa->nim }}">

                <span class="text-danger" id="nimErr"></span>
            </div>
            <div class="form-group">
                <label for="nama">Nama :</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="{{ $mahasiswa->nama }}">

                <span class="text-danger" id="namaErr"></span>
            </div>
            <div class="form-group">
                <label for="foto">Upload foto :</label><br>
                <img src="{{ asset('storage') }}/{{ $mahasiswa->foto }}" width="80px" class="mb-2">
                <input type="file" id="foto" name="foto">

                <span class="text-danger" id="fotoErr"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="no_telp">No telp :</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="08xxxxx" value="{{ $mahasiswa->no_telp }}">

                <span class="text-danger" id="no_telpErr"></span>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat :</label>
                <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5" placeholder="Alamat">{{ $mahasiswa->alamat }}</textarea>

                <span class="text-danger" id="alamatErr"></span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="buttonUpdate">UBAH</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
</form>
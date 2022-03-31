<form action="" method="POST" autocomplete="off" id="formEdit">
    @method('put')
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">

            <input type="hidden" value="{{ $Kandidat->id }}" id="id_data" name="id">

            <div class="form-group">
                <label for="no_urut">No urut :</label>
                <input type="number" class="form-control" id="no_urut" name="no_urut" value="{{ $Kandidat->no_urut }}">

                <span class="text-danger" id="noUrutErr"></span>
            </div>
            <div class="form-group">
                <label for="calon_ketua">Calon Katua :</label>
                <select name="calon_ketua" id="calon_ketua" class="form-control select2">
                    @foreach($Mahasiswa as $mhs)
                    <option value="{{ $mhs->id }}" {{ ($Kandidat->calon_ketua == $mhs->id ? 'selected' : '') }}>{{ $mhs->nama }}</option>
                    @endforeach
                </select>

                <span class="text-danger" id="calonKetuaErr"></span>
            </div>
            <div class="form-group">
                <label for="calon_wakil">Calon Wakil :</label>
                <select name="calon_wakil" id="calon_wakil" class="form-control select2">
                    @foreach($Mahasiswa as $mhs)
                    <option value="{{ $mhs->id }}" {{ ($Kandidat->calon_wakil == $mhs->id ? 'selected' : '') }}>{{ $mhs->nama }}</option>
                    @endforeach
                </select>

                <span class="text-danger" id="calonWakilErr"></span>
            </div>
            <div class="form-group">
                <label for="visi_misi">Visi & Misi :</label>
                <textarea name="visi_misi" id="visi_misi" cols="30" rows="10" class="form-control">{{ $Kandidat->visi_misi }}</textarea>

                <span class="text-danger" id="visiMisiErr"></span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btn-ubah">UBAH</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
</form>
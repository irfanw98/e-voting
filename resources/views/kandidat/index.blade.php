@extends('stisla.master')

@section('css')

<style>
    #datatable {
        text-align: center;
    }
</style>

@endsection

@section('title')

<h1>{{ $Title }}</h1>

@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header">
                <button class="btn btn-sm btn-flat btn-warning btn-refresh mb-3"><i class="fas fa-sync-alt"></i> REFRESH</button>

                <button type="button" name="tambahData" id="tambahData" class="btn btn-sm btn-primary mb-3"><i class="fa fa-plus-square"></i> KANDIDAT</button>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered nowrap hover" id="datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No Urut</th>
                                    <th>Calon Ketua</th>
                                    <th>Calon Wakil</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<!-- Modal Tambah data -->
<div class="modal fade modal-form" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kandidat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('kandidat/add') }}" method="POST" autocomplete="off" id="formInsert">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">

                            <input type="hidden" name="id" id="id">

                            <div class="form-group">
                                <label for="no_urut">No urut :</label>
                                <input type="number" class="form-control" id="no_urut" name="no_urut" placeholder="No urut">

                                <span class="text-danger" id="noUrutError"></span>
                            </div>
                            <div class="form-group">
                                <label for="calon_ketua">Calon Ketua :</label>
                                <select name="calon_ketua" id="calon_ketua" class="form-control select2">
                                    <option value="">==PILIH KETUA==</option>
                                    @foreach($Mahasiswa as $mhs)
                                    <option value="{{ $mhs->id }}">{{ $mhs->nama }}</option>
                                    @endforeach
                                </select>

                                <span class="text-danger" id="calonKetuaError"></span>
                            </div>
                            <div class="form-group">
                                <label for="calon_wakil">Calon Wakil :</label>
                                <select name="calon_wakil" id="calon_wakil" class="form-control select2">
                                    <option value="">==PILIH WAKIL==</option>
                                    @foreach($Mahasiswa as $mhs)
                                    <option value="{{ $mhs->id }}">{{ $mhs->nama }}</option>
                                    @endforeach
                                </select>

                                <span class="text-danger" id="calonWakilError"></span>
                            </div>
                            <div class="form-group">
                                <label for="visi_misi">Visi & Misi :</label>
                                <textarea name="visi_misi" id="visi_misi" cols="30" rows="10" class="form-control" placeholder="Visi misi"></textarea>

                                <span class="text-danger" id="visiMisiError"></span>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="buttonAdd" value="add">TAMBAH</button>
                <button type="button" class="btn btn-danger" id="buttonCancel" data-dismiss="modal">BATAL</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Ubah data -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Ubah Kandidat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

@section('js')

<script type="text/javascript">
    $(document).ready(function() {

        // btn refresh
        $('.btn-refresh').click(function(e) {
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })

    });
    $(document).ready(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            scrollX: true,
            scrollCollapse: true,
            ajax: {
                url: "{{ url('kandidat') }}",
                type: "GET",
                dataType: "JSON"
            },
            columns: [{
                    data: 'no_urut',
                    name: 'no_urut'
                },
                {
                    'data': 'mhscalonketua',
                    name: 'mhscalonketua.nama'
                },
                {
                    'data': 'mhscalonwakil',
                    name: 'mhscalonwakil.nama'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'Aksi',
                    name: 'Aksi'
                }
            ]
        });
    });


    //Insert data
    $('#tambahData').on('click', function(e) {
        e.preventDefault();
        $('#exampleModal').modal('show'); //Menampilkan pop up modal
    });

    //Form Insert
    $('#formInsert').on('submit', function(e) {
        e.preventDefault();
        no_ururt = $('#noUrutError').val();
        visi_misi = $('#visiMisiError').val();

        if ($('#buttonAdd').val() == 'add') {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('kandidat/add') }}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                cache: false,
                dataType: "JSON",
                success: function(data) {
                    $('#exampleModal').modal('hide');
                    $('#datatable').DataTable().ajax.reload();
                    document.getElementById("formInsert").reset();

                    swal("Kandidat berhasil ditambahkan!", {
                        icon: 'success',
                    });
                },
                error: function(data) {
                    $('#noUrutError').text(data.responseJSON.errors.no_urut);
                    $('#visiMisiError').text(data.responseJSON.errors.visi_misi);
                }
            });

        }
    });

     //Reset error message button cancel
    $('#buttonCancel').on('click', function(e){
        // console.log('OKE');
        $('#noUrutError').addClass('d-none');
        $('#visiMisiError').addClass('d-none');
    });

    //Edit Data
    $(document).on('click', '.edit', function(e) {
        e.preventDefault();

        const data_id = $(this).data('id');
        const url = "kandidat/" + data_id;

        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                $('#editModal').find('.modal-body').html(response);
                $('#editModal').modal('show'); //Menampilkan pop up modal
            },
        });
    });

    //Form Edit
    $(document).on('click', '#btn-ubah', function(e) {
        e.preventDefault();
        const form_id = $('input[id=id_data]').val();
        let form = $('#formEdit')[0];
        const formData = new FormData(form);
        const url = "kandidat/" + form_id;

        no_urut = $('#no_urut').val();
        visi_misi = $('#visi_misi').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: 'POST',
            processData: false, // Important!
            contentType: false,
            cache: false,
            data: formData,
            dataType: "JSON",
            success: function(data) {
                $('#editModal').modal('hide');
                $('#datatable').DataTable().ajax.reload();

                swal("Kandidat berhasil diubah!", {
                    icon: 'success',
                });
            },
            error: function(data) {

                $('#noUrutErr').text(data.responseJSON.errors.no_urut);
                $('#visiMisiErr').text(data.responseJSON.errors.visi_misi);

            }
        });
    });

    //Delete Data
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        const kandidat_id = $(this).attr('kandidat-id');
        const kandidat_noUrut = $(this).attr('kandidat-no_urut');
        const url = "kandidat/" + kandidat_id;

        swal({
                title: "Yakin?",
                text: "Kandidat dengan no urut " + kandidat_noUrut + " akan dihapus?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((result) => {
                if (result) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        type: "POST",
                        data: {
                            '_method': 'DELETE',
                            'id': kandidat_id,
                        },
                        success: function(response) {
                            $('#datatable').DataTable().ajax.reload();

                            swal("Kandidat berhasil dihapus!", {
                                icon: 'success',
                            });

                        }
                    });
                }
            });
    });
</script>

@endsection
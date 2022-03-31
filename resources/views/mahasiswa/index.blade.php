@extends('stisla.master')

@section('css')

<style>
    #datatable {
        text-align: center;
    }
</style>

@endsection

@section('title')

<h1>{{ $title }}</h1>

@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header">
                <button class="btn btn-sm btn-flat btn-warning btn-refresh mb-3"><i class="fas fa-sync-alt"></i> REFRESH</button>

                <button name="tambahData" id="tambahData" class="btn btn-sm btn-primary mb-3"><i class="fa fa-plus-square"></i> MAHASISWA</button>

                <a href="{{ url('export/excel') }}" class="btn btn-sm btn-success mb-3 float-right"><i class="fas fa-file-excel"></i> EXCEL</a>
                <a href="{{ url('export/pdf') }}" class="btn btn-sm btn-danger mb-3 mr-1 float-right"><i class="fas fa-file-pdf"></i> PDF</a>

            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered dataTable no-footer text-center hover nowrap" id="datatable" role="grid" aria-describedby="table-1_info">
                            <thead>
                                <tr role="row">
                                    <th class="text-center sorting_asc" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 24px;">
                                        No
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" aria-label="Task Name: activate to sort column ascending" style="width: 148px;">Nama</th>
                                    <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" aria-label="Task Name: activate to sort column ascending" style="width: 148px;">Nim</th>
                                    <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" aria-label="Task Name: activate to sort column ascending" style="width: 148px;">No Telp</th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Progress" style="width: 79px;">Alamat</th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Members" style="width: 208px;">Foto</th>
                                    <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" aria-label="Due Date: activate to sort column ascending" style="width: 89px;">Created At</th>
                                    <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 108px;">Updated At</th>
                                    <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 75px;">Action</th>
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
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('mahasiswa/add') }}" method="POST" autocomplete="off" id="formInsert" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">

                            <input type="hidden" name="id" id="id">

                            <div class="form-group">
                                <label for="nim">Nim :</label>
                                <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM">

                                <span class="text-danger" id="nimError"></span>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama :</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">

                                <span class="text-danger" id="namaError"></span>
                            </div>
                            <div class="form-group">
                                <label for="foto">Upload foto :</label>
                                <input type="file" id="foto" name="foto">
                                <span class="text-danger" id="fotoError"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_telp">No telp :</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control phone-number" id="no_telp" name="no_telp" placeholder="08xxxxx">
                                </div>

                                <span class="text-danger" id="no_telpError"></span>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat :</label>
                                <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5" placeholder="Alamat"></textarea>


                                <span class="text-danger" id="alamatError"></span>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="buttonAdd" value="Add">TAMBAH</button>
                <button type="button" class="btn btn-danger" id="buttonCancel" value="cancel" data-dismiss="modal">BATAL</button>
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
                <h5 class="modal-title" id="editModalLabel">Ubah Mahasiswa</h5>
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
                url: "{{ url('mahasiswa') }}",
                type: "GET",
                dataType: "JSON"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nim',
                    name: 'nim'
                },
                {
                    data: 'no_telp',
                    name: 'no_telp'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'foto',
                    name: 'foto',
                    render: function(data, type, full, meta) {
                        return "<img src={{ asset('storage') }}/" + data + " width='80' height='70'/>";
                    },
                    orderable: false
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

    //Tambah data
    $('#tambahData').on('click', function(e) {
        e.preventDefault();
        $('#buttonAdd').val('Add');
        $('#formInsert').trigger('reset');
        $('#tambahModal').modal('show'); //Menampilkan pop up modal
    });

    $('#buttonAdd').click(function(e) {
        // console.log('OKE!!');
        e.preventDefault();
        let form = $('#formInsert')[0];
        const formData = new FormData(form);
        $('#nimError').addClass('d-none');
        $('#namaError').addClass('d-none');
        $('#no_telpError').addClass('d-none');
        // $('#fotoError').addClass('d-none');
        $('#alamatError').addClass('d-none');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('mahasiswa/add') }}",
            method: "POST",
            data: formData,
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            cache: false,
            dataType: "JSON",
            success: function(data) {

                $('#formInsert').trigger('reset');
                $("#tambahModal").modal("hide");
                $("#datatable").DataTable().ajax.reload();

                swal("Mahasiswa berhasil ditambahkan!", {
                    icon: 'success',
                });
            },
            error: function(data) {

                let errors = data.responseJSON;
                if ($.isEmptyObject(errors) == false) {
                    $.each(errors.errors, function(key, value) {
                        let errID = '#' + key + 'Error';
                        $('#nim').removeClass('is-valid');
                        $('#nim').addClass('is-invalid');
                        $('#nama').removeClass('is-valid');
                        $('#nama').addClass('is-invalid');
                        $('#no_telp').removeClass('is-valid');
                        $('#no_telp').addClass('is-invalid');
                        $('#alamat').removeClass('is-valid');
                        $('#alamat').addClass('is-invalid');
                        $(errID).removeClass('d-none');
                        $(errID).text(value);
                    });
                }
            }
        });
    });

    //Reset error message button cancel
    $('#buttonCancel').on('click', function(e) {
        // console.log('OKE');
        $('#nimError').addClass('d-none');
        $('#namaError').addClass('d-none');
        $('#no_telpError').addClass('d-none');
        $('#fotoError').addClass('d-none');
        $('#alamatError').addClass('d-none');

        //error message
        $('#nim').removeClass('is-invalid');
        $('#nama').removeClass('is-invalid');
        $('#no_telp').removeClass('is-invalid');
        $('#alamat').removeClass('is-invalid');
    });


    //Edit Data
    $(document).on('click', '.edit', function(e) {
        e.preventDefault();

        const data_id = $(this).data('id');
        // console.log(data_id);
        const url = "mahasiswa/" + data_id;
        // console.log(url);

        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                // console.log(response);
                $('#editModal').find('.modal-body').html(response);
                $('#editModal').modal('show'); //Menampilkan pop up modal
            },
        });
    });

    $(document).on('click', '#buttonUpdate', function(event) {
        event.preventDefault();
        const form_id = $('input[id=id_data]').val();
        // console.log(form_id);
        // const form_data = $('#editForm').serialize();
        let form = $('#editForm')[0];
        const formData = new FormData(form);
        formData.append('_method', 'put');
        formData.append('_token', "{{ csrf_token() }}");
        // console.log(form_data);
        const url = `mahasiswa/${form_id}/edit`;
        // console.log(url);


        let nim = $('#nim').val();
        let nama = $('#nama').val();
        let no_telp = $('#no_telp').val();
        let foto = $('#foto').val();
        let alamat = $('#alamat').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: 'POST',
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            data: formData,
            dataType: 'JSON',
            success: function(data) {
                $('#editForm').trigger("reset");
                $('#editModal').modal('hide');
                $('#datatable').DataTable().ajax.reload();

                swal("Mahasiswa berhasil diubah!", {
                    icon: 'success',
                });

            },
            error: function(data) {
                $('#nimErr').text(data.responseJSON.errors.nim);
                $('#namaErr').text(data.responseJSON.errors.nama);
                $('#no_telpErr').text(data.responseJSON.errors.no_telp);
                $('#fotoErr').text(data.responseJSON.errors.foto);
                $('#alamatErr').text(data.responseJSON.errors.alamat);
            }
        });
    });

    //Delete Data
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        const mahasiswa_id = $(this).attr('mahasiswa-id');
        const mahasiswa_nama = $(this).attr('mahasiswa-nama');
        const url = "mahasiswa/" + mahasiswa_id;

        swal({
                title: "Yakin?",
                text: "Data mahasiswa dengan nama " + mahasiswa_nama + " akan dihapus?",
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
                            'id': mahasiswa_id,
                        },
                        success: function(response) {

                            // console.log(response);
                            $('#datatable').DataTable().ajax.reload();

                            swal("Mahasiswa, atas nama " + mahasiswa_nama + " berhasil dihapus!", {
                                icon: 'success',
                            });

                        }
                    });
                }
            });
    });
</script>

@endsection
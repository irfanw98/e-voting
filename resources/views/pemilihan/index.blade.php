@extends('stisla.master')

@section('css')

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
            </div>
            <div class="box-body">
                @foreach($kandidat as $calon)
                <div class="row justify-content-md-center">
                    <div class="col-md-3 card text-center p-3 mb-2">
                        <h4>{{ $calon->no_urut }}</h4>
                    </div>
                </div>

                <div class="row justify-content-around">
                    <div class="col-4 text-center p-3">
                        <a type="submit" href="#" class="btn btn-sm btn-primary voting mb-3" no-urut="{{ $calon->no_urut }}" pemilihan-id="{{ $calon->id }}"><i class="fas fa-check-circle"></i> Pilih Paslon</a>
                    </div>
                    <div class="col-4 text-center p-3">
                        <button class="btn btn-sm btn-warning mb-3 vmModal" data-id="{{ $calon->id }}"><i class="fas fa-info-circle"></i> Visi & Misi</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="card mt-4">
                            <div class="card-header bg-success">
                                <h4 class="text-white">Calon Ketua</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled user-details list-unstyled-border list-unstyled-noborder">
                                    <li class="media">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <img alt="image" class="mr-3 img-thumbnail" width="200" src="{{ asset('storage') }}/{{  $calon->mhscalonketua->foto }}">
                                                <p style="margin-top: 1px; font-weight: bold;">{{ $calon->mhscalonketua->nama }}</p>
                                            </div>
                                            <div class="col-md-7">
                                                <ul>
                                                    <li>{{ $calon->mhscalonketua->nim }}</li>
                                                    <li>{{ $calon->mhscalonketua->no_telp }}</li>
                                                    <li>{{ $calon->mhscalonketua->alamat }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card mt-4">
                            <div class="card-header bg-success">
                                <h4 class="text-white">Calon Wakil</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled user-details list-unstyled-border list-unstyled-noborder">
                                    <li class="media">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <img alt="image" class="mr-3 img-thumbnail" width="200" src="{{ asset('storage') }}/{{  $calon->mhscalonwakil->foto }}">
                                                <p style="margin-top: 1px; font-weight: bold;">{{ $calon->mhscalonwakil->nama }}</p>
                                            </div>
                                            <div class="col-md-7">
                                                <ul>
                                                    <li>{{ $calon->mhscalonwakil->nim }}</li>
                                                    <li>{{ $calon->mhscalonwakil->no_telp }}</li>
                                                    <li>{{ $calon->mhscalonwakil->alamat }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection


<!-- Modal Visi & Misi -->
<div class="modal fade" id="visiMisiModal" tabindex="-1" role="dialog" aria-labelledby="visiMisiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="visiMisiLabel">Visi & Misi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">TUTUP</button>
                </form>
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

    //Visi Misi
    $(document).on('click', '.vmModal', function(e) {
        // console.log('OKE');
        e.preventDefault();

        const data_id = $(this).data('id');
        // console.log(data_id);
        const url = 'pemilihan/' + data_id;
        // console.log(url);

        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                // console.log(response);
                $('#visiMisiModal').find('.modal-body').html(response);
                $('#visiMisiModal').modal('show'); //Menampilkan pop up modal
            },
        });
    });

    //Voting
    $(document).on('click', '.voting', function() {
        // console.log('OKE');
        const vote_id = $(this).attr('pemilihan-id');
        const no_urut = $(this).attr('no-urut');
        // console.log(no_urut);

        swal({
                title: "Yakin ?",
                text: "Anda memilih no urut " + no_urut + " ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((response) => {
                // console.log(response);
                if (response) {
                    window.location = "pemilihan/" + vote_id + "/vote";
                    //return sweetalert ada di controller
                }
            });
    });
</script>
@endsection
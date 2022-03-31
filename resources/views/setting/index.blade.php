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
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ url('ganti_password') }}" method="POST" autocomplete="off" class="border p-3 rounded">
                    {{ csrf_field() }}
                    <div class=" row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password_lama">Password Lama :</label>
                                <input type="password" name="password_lama" id="password_lama" class="form-control" placeholder="Masukkan Password Lama">

                                @error('password_lama')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password Baru :</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password Baru">
                                @error('password')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password Baru :</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi Password Baru">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-inline-flex p-1">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

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
</script>

@endsection
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
                <form role="form" method="POST" action="{{ url('periode') }}" class="border p-3 rounded">
                    @csrf
                    <div class=" box-body">
                    <div class="form-group">
                        <label for="dari">Dari Tanggal :</label>
                        <input type="text" class="form-control datepicker" name="dari" id="dari" placeholder="Dari Tanggal" autocomplete="off" value="{{ date('Y-m-d', strtotime($dari->tanggal)) }}">
                    </div>
                    <div class="form-group">
                        <label for="sampai">Sampai Tanggal :</label>
                        <input type="text" class="form-control datepicker" id="sampai" name="sampai" placeholder="Sampai Tanggal" autocomplete="off" value="{{ date('Y-m-d', strtotime($sampai->tanggal)) }}">
                    </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
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

    //Datepicker
    $(".datepicker").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    });
</script>
@endsection
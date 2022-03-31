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
                <a href="{{ url('reset') }}" class="btn btn-danger btn-sm delete float-right mr-2" role="button" onclick="return confirm('Reset pemilihan?')"><i class="fa fa-trash"></i> RESET PEMILIHAN</a>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <div id="chartPemilihan"></div>
                    </div>
                    <div class="col-md-4 mt-2 border p-3 rounded">
                        <table class="table table-bordered style='width:100%' ">
                            <h5>Jumlah Pemilih</h5>
                            <tbody>
                                @foreach($hasil as $hsl)
                                <tr>
                                    <td>{{ $hsl['name'] }}</td>
                                    <td> : </td>
                                    <td>{{ $hsl['y'] }} Pemilih</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        //Grafik
        Highcharts.chart('chartPemilihan', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Grafik Hasil Pemilihan Calon Ketua - Wakil BEM'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Hasil Pemilihan',
                colorByPoint: true,
                data: {!!json_encode($hasil)!!}
            }]
        });


        // btn refresh
        $('.btn-refresh').click(function(e) {
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })

    });
</script>

@endsection
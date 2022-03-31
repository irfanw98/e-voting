<!-- start banner Area -->
<section class="banner-area relative" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-between">
            <div class="banner-content col-lg-9 col-md-12">
                <h1 class="text-uppercase fr-text">
                    SELAMAT DATANG DI WEBSITE <span>ONLINE VOTING</span> KAMPUSKU
                </h1>
                <p class="pt-10 pb-10 sub-text">
                    Login untuk memilih calon ketua - wakil badan eksekutif mahasiswa (BEM)
                </p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- Periode Mulai -->
<section class="feature-area" id="periode">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="single-feature">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="single-feature">
                    <div class="title text-uppercase">
                        <h4>WAKTU VOTING BERLANGSUNG</h4>
                    </div>
                    <div class="desc-wrap">
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="single-feature">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Periode -->

<!-- Calon Ketua Wakil BEM -->
<section class="popular-course-area section-gap" id="paslon">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center text-uppercase">
                    <h1 class="mb-10 calon">Calon Ketua - Wakil BEM</h1>
                </div>
            </div>
        </div>
        @foreach($kandidat as $calon)
        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-center mt-3 font-italic">
                <h3>No Urut {{ $calon->no_urut }}</h3>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 d-flex justify-content-center p-3 font-weight-bold kandidat">
                <img src="{{ asset('storage') }}/{{  $calon->mhscalonketua->foto }}" width="300">
                <p>{{ $calon->mhscalonketua->nama }}</p>
            </div>
            <div class="col-md-6 d-flex justify-content-center p-3 font-weight-bold kandidat">
                <p>{{ $calon->mhscalonwakil->nama }}</p>
                <img src="{{ asset('storage') }}/{{  $calon->mhscalonwakil->foto }}" width="300">
            </div>
        </div>
        @endforeach
    </div>
</section>
<!-- End Calon Ketua Wakil BEM -->

<!-- Visi & Misi-->
<section class="search-course-area relative" id="vm">
    <div class="overlay overlay-bg"></div>
    <div class="container pt-3 pb-3 visiMisi">
        <div class="row visiMisi">
            <div class="col-lg-12 col-md-12 pt-3">
                <h1 class="text-white text-center">
                    VISI & MISI
                </h1>
            </div>
        </div>
        <div class="row p-3 visiMisi">
            @foreach($kandidat as $kd)
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>No Urut {{ $kd->no_urut }}</h3>
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>{{ $kd->visi_misi }}</p>
                        </blockquote>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End Visi & Misi -->

<!-- Hasil Hitung Cepat -->
<section class="upcoming-event-area section-gap" id="hasil">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center text-uppercase">
                    <h1 class="mb-10 quick-count">HASIL HITUNG CEPAT</h1>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 d-flex justify-content-center p-3">
                <div id="chart"></div>
            </div>
        </div>
    </div>
</section>
<!-- End Hasil Hitung Cepat -->

<!-- Cara Voting -->
<section class="review-area section-gap relative" id="voting">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="title text-center text-uppercase">
                <h1 class="mb-10 cara-voting">CARA VOTING</h1>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-3">
            <div class="title text-center">
                <h6 class="mb-10 panduan">Pilih dan ikuti panduan di bawah ini untuk melakukan voting</h6>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="title">
                <div class="box mt-3">
                    <ul>
                        <li><span>1</span>Pilih menu login</li>
                        <li><span>2</span>Masukkan nim dan password yang telah diberikan admin</li>
                        <li><span>3</span>Klik menu profile pojok kanan atas</li>
                        <li><span>4</span>Pilih menu setting</li>
                        <li><span>5</span>Ganti password anda</li>
                        <li><span>6</span>Pilih menu pemilihan</li>
                        <li><span>7</span>Klik tombol pilih</li>
                        <li><span>8</span>Selesai</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Cara Voting -->

<!-- Slogan -->
<section class="cta-two-area">
    <div class="container">
        <div class="row ">
            <div class="col-lg-12 cta-left text-center">
                <h1>Tunggu Apa Lagi? Ayo ... Vote Jagoanmu Sekarang!!!</h1>
            </div>
        </div>
    </div>
</section>
<!-- End slogan -->


@section('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    // $('[data-countdown]').each(function() {
    //     var $this = $(this),
    //         finalDate = $(this).data('countdown');
    //     $this.countdown(finalDate, function(event) {
    //         $this.html(event.strftime('%D Hari %H:%M:%S'));
    //     });
    // });

    // Build the chart
    Highcharts.chart('chart', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Statistik Pemilihan Ketua - Wakil BEM'
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
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Presentase',
            colorByPoint: true,
            data: {!!json_encode($hasil)!!}
        }]
    });
</script>
@endsection
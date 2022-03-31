@extends('stisla.master')

@section('css')

@endsection

@section('title')

<h1>{{ $Title }}</h1>

@endsection

@section('content')


<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <center>
                                        <h1>
                                            <strong>
                                                No. Urut {{ $Kandidat->no_urut }}
                                            </strong>
                                        </h1>
                                    </center>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-md-6 mt-2">
                                    <center>
                                        <h4>{{ $Kandidat->mhscalonketua->nama }}</h4>
                                    </center>
                                    <center class="mt-3">
                                        <img src="{{ asset('storage') }}/{{  $Kandidat->mhscalonketua->foto }}" width="300px" class="img-thumbnail rounded-circle">
                                    </center>
                                    <center class="mt-2">
                                    </center>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <center>
                                        <h4>{{ $Kandidat->mhscalonwakil->nama }}</h4>
                                    </center>
                                    <center class="mt-3">
                                        <img src="{{ asset('storage') }}/{{  $Kandidat->mhscalonwakil->foto }}" width="300px" class="img-thumbnail rounded-circle">
                                    </center>
                                    <center class="mt-2">
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>
                                        <strong>VISI & MISI :</strong>
                                    </h4>
                                    <hr>
                                </div>
                            </div>
                            <div class="row m-auto">
                                {{ $Kandidat->visi_misi }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

@endsection
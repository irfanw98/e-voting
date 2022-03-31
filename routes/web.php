<?php

use Illuminate\Support\Facades\Route;



//Halaman Landing page
Route::get('/', 'HaldepanController@index');

Auth::routes();

//Login admin dan mahasiswa
Route::group(['middleware' => ['auth','checkRole:admin,mahasiswa']], function () {
    //Dashboard
    Route::get('dashboard', 'BerandaController@index')->name('dashboard');

    //Menu Setting
    Route::get('setting', 'BerandaController@setting');
    //Ganti Password
    Route::post('ganti_password', 'BerandaController@passwordBaru');

    //Logout
    Route::get('keluar', 'HaldepanController@keluar');
    
});

//Login admin
Route::group(['middleware' => ['auth','checkRole:admin']], function () {

    //Manage Mahasiswa(Modul Mahasiswa)
    Route::get('mahasiswa', 'MahasiswaController@index');

    Route::get('mahasiswa/add', 'MahasiswaController@add');
    Route::post('mahasiswa/add', 'MahasiswaController@store');

    Route::get('mahasiswa/{id}', 'MahasiswaController@edit');
    Route::put('mahasiswa/{id}/edit', 'MahasiswaController@update')->name('mahasiswa.update');

    Route::delete('mahasiswa/{id}', 'MahasiswaController@delete');
    //Eksport 
    Route::get('export/excel', 'MahasiswaController@laporanExcel');
    Route::get('export/pdf', 'MahasiswaController@laporanPdf');

    //Manage Kandidat(Modul Kandidat)
    Route::get('kandidat', 'KandidatController@index');
    Route::get('kandidat/detail/{id}', 'KandidatController@detail');
    Route::post('kandidat/add', 'KandidatController@store');

    Route::get('kandidat/{id}', 'KandidatController@edit');
    Route::put('kandidat/{id}', 'KandidatController@update');

    Route::delete('kandidat/{id}', 'KandidatController@delete');

    //Manage Periode(Modul Periode)
    Route::get('periode', 'PeriodeController@index');
    Route::post('periode', 'PeriodeController@setPeriode');

    //Manage Hasil Pemilihan(Modul Hasil)
    Route::get('hasil', 'HasilController@index');
    Route::get('reset', 'HasilController@reset');
});

//Login mahasiswa
Route::group(['middleware' => ['auth','checkRole:mahasiswa']], function () {
    //Manage Pemilihan(Modul Pemilihan)
    Route::get('pemilihan', 'PemilihanController@index');

    Route::get('pemilihan/{id}', 'PemilihanController@visi_misi');
    Route::get('pemilihan/{id}/vote', 'PemilihanController@vote'); //Voting(Melakukan Pemilihan)
});


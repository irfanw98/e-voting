<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Hash;
use App\Models\M_mahasiswa;
use App\Models\Kandidat;
use App\Models\Periode;
use App\Models\Voting;
use App\User;
use App\Http\Requests\GantiPasswordRequest;

class BerandaController extends Controller
{

    public function index()
    {
        $title = 'Selamat Datang Di Pemilihan Ketua - Wakil BEM';

        //Mengambil jumlah data mahasiswa
        $mahasiswa = M_mahasiswa::all()->count();
        // $mhs = M_mahasiswa::get();
        // foreach ($mhs as $key => $val) {
        //     $val_foto = $val->foto;
        // }
        // // dd($val_foto);

        //Mengambil jumlah data kandidat
        $knd = Kandidat::all()->count();

        //Mengambil periode pemilihan
        $dari = Periode::orderBy('tanggal', 'asc')->first();
        $sampai = Periode::orderBy('tanggal', 'desc')->first();

        //Mengambil jumlah data pemilih
        $pemilih = Voting::all()->count();


        $hasil = [];

        $kandidat = Kandidat::get();
        foreach ($kandidat as $key => $kd) {
            $kandidat_id = $kd->id;
            $kandidat_noUrut = $kd->no_urut;
            $total = Voting::where('kandidat_id', $kandidat_id)->count();

            $chart['name'] = 'No urut ' . $kandidat_noUrut;
            $chart['y'] = $total;
            array_push($hasil, $chart);
        }


        return view('beranda.index', compact('title','mahasiswa', 'knd', 'dari', 'sampai', 'pemilih', 'hasil'));
    }

    public function setting()
    {
        $title = 'Ganti Password';
        $user = \Auth::user()->id;
        $mahasiswa = M_mahasiswa::get();
        foreach ($mahasiswa as $key => $mhs) {
            $mahasiswa_foto = $mhs->foto;
        }
        return view('setting.index', compact('title', 'user', 'mahasiswa_foto'));
    }

    public function passwordBaru(GantiPasswordRequest $request)
    {

        $password_default = \Auth::user()->password; //password default
        $password_sekarang = request('password_lama');
        $user_id = \Auth::user()->id;
        

        if(Hash::check($password_sekarang, $password_default)){
            $user = User::findOrFail($user_id);
            $user->password = Hash::make($request->input('password'));

            if($user->save()){
                // Jika Berhasil disimpan...
                 return redirect()->back()->with('success', 'Ganti password berhasil.');
            } else {
                return redirect()->back()->with('errors', 'Ganti Password gagal.');
            }
        } else {
            return redirect()->back()->withErrors(['password_lama' => 'Input password lama salah.']);
        }   
    }
}

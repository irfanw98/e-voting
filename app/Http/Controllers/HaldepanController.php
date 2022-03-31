<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;
use App\Models\Kandidat;
use App\Models\Voting;

class HaldepanController extends Controller
{
    public function index()
    {
        //Mulai Voting
        $sampai = Periode::orderBy('tanggal', 'desc')->first();
        $dari = Periode::orderBy('tanggal', 'asc')->first();

        //Kandidat
        $kandidat = Kandidat::orderBy('no_urut', 'asc')->get();


        $hasil = [];
        $kandidat = Kandidat::get();
        $voting = Voting::get()->count();
        
        //Jika belum ada voting
        if($voting == 0){
            $chart['name'] = 'Belum ada pemilihan';
            $chart['y'] = 100;
            array_push($hasil, $chart);  
        } else{
            foreach ($kandidat as $key => $kd) {
            $kandidat_id = $kd->id;
            $kandidat_noUrut = $kd->no_urut;
            $total = Voting::where('kandidat_id', $kandidat_id)->count();

            $chart['name'] = 'No urut ' . $kandidat_noUrut;
            $chart['y'] = $total;
            array_push($hasil, $chart);   
            }
        }

        return view('frontend.frontend', compact('sampai', 'dari', 'kandidat', 'hasil'));
    }

    public function keluar()
    {
        \Auth::logout();
        return redirect('/');
    }
}

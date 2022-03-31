<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kandidat;
use App\Models\Voting;

class HasilController extends Controller
{
    public function index()
    {
        $title = 'Hasil Pemilihan Calon Ketua - Wakil BEM';
        $hasil = [];

        $kandidat = Kandidat::get();
        $voting = Voting::get()->count();
        
        //Jika belum ada voting
        if($voting == 0){
            $chart['name'] = 'Belum ada pemilihan';
            $chart['y'] = 0;
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

        return view('grafik.index', compact('title', 'hasil'));
    }

    public function reset(){
        $voting = Voting::all();
        $voting->each->delete();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Kandidat;
use App\Models\Voting;
use App\Models\M_mahasiswa;
use App\Models\Periode;
use App\Events\MyEvent;

class PemilihanController extends Controller
{
    public function index()
    {
        $title = 'Tentukan Pilihan Terbaikmu';
        $kandidat = Kandidat::orderBy('no_urut', 'asc')->get();

        return view('pemilihan.index', compact('title', 'kandidat'));
    }

    public function visi_misi($id)
    {
        $kandidat = Kandidat::findOrFail($id);
        // dd($kandidat);
        return view('pemilihan.visiMisi', compact('kandidat'));
    }

    public function vote($id)
    {
        //Setting Periode vote
        $tanggal_sekarang = date('Y-m-d');
        $cek_periode = Periode::where('tanggal', $tanggal_sekarang)->count();

        if ($cek_periode > 0) {
            $mhs = M_mahasiswa::where('user_id', \Auth::user()->id)->first();
            $id_mhs = $mhs->id;
            $cek = Kandidat::where('calon_ketua', $id_mhs)->orWhere('calon_wakil', $id_mhs)->count();

            if ($cek > 0) {
                return redirect('pemilihan')->with('errors', 'Maaf anda adalah kandidat, tidak bisa melakukan vote.');
            } else {

                $cekId = Voting::where('user_id', \Auth::user()->id)->exists();
                // dd($cekId); //hasilnya -> true

                if ($cekId == false) {
                    $voting = Voting::firstOrCreate(
                        ['user_id' => \Auth::user()->id], //Cek apakah user sudah vote atau belum
                        ['kandidat_id' => $id, 'user_id' => \Auth::user()->id]
                    );
                    // event(new MyEvent('Terimakasih, sudah berpartisipasi dalam pemilihan BEM.')); //Notifikasi pusher
                    return redirect('pemilihan')->with('success', 'Selamat, anda telah berhasil melakukan pemilihan.');
                } else {
                    return redirect('pemilihan')->with('errors', 'Maaf, anda hanya bisa melakukan pemilihan 1x.');
                }
            }
        } else {
            return redirect('pemilihan')->with('errors', 'Maaf anda tidak bisa melakukan pemilihan, karena diluar periode pemilihan.');
        }
    }
}

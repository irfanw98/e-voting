<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;

class PeriodeController extends Controller
{
    public function index()
    {
        $title = 'Set Periode';
        $dari = Periode::orderBy('tanggal', 'asc')->first();
        $sampai = Periode::orderBy('tanggal', 'desc')->first();

        return view('periode.index', compact('title', 'dari', 'sampai'));
    }

    public function setPeriode(Request $request)
    {
        // dd($request->tanggal);
        $dari = $request->dari;
        $sampai = $request->sampai;

        $tanggal1 = date('Y-m-d H:i:s', strtotime($dari));
        $tanggal2 = date('Y-m-d H:i:s', strtotime($sampai));

        \DB::table('periode')->delete();

        while ($tanggal1 <= $tanggal2) {
            $periode = new Periode;
            $periode->tanggal = $tanggal1;
            $periode->save();

            $tanggal1 = date('Y-m-d H:i:s', strtotime('+1 days', strtotime($tanggal1)));
        }
        return redirect('periode')->with('success', 'Periode berhasil diset.');
    }
}

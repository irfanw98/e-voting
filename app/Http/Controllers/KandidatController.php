<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\M_mahasiswa;
use Illuminate\Http\Request;


class KandidatController extends Controller
{
    public function index(Request $request)
    {
        $Title = 'Kandidat Calon Ketua - Wakil BEM';
        $Mahasiswa = M_mahasiswa::orderBy('nama', 'asc')->get();
        $Kandidat = Kandidat::with(['mhscalonketua'])->orderBy('no_urut', 'asc')->get();
        // return response()->json(['data' => $Kandidat]);

        if ($request->ajax()) {
            return \datatables()::of($Kandidat)
                ->addColumn('mhscalonketua', function ($row) {
                    return $row->mhscalonketua->nama;
                })
                ->addColumn('mhscalonwakil', function ($row) {
                    return $row->mhscalonwakil->nama;
                })
                ->addColumn('Aksi', function ($data) {
                    return
                        '<div class="row">
                            <div class="col-xs-4 m-1">
                                <a href="kandidat/detail/' . $data->id . '" class="btn btn-success btn-xs detail" role="button"><i class="fa fa-eye"></i></a>
                            </div>
                            <div class="col-xs-4 m-1">
                                <a href="" class="btn btn-warning btn-xs edit" data-id="' . $data->id . '" role="button"><i class="fa fa-edit"></i></a>
                            </div>
                            <div class="col-xs-4 m-1">
                                <a href="" class="btn btn-danger btn-xs delete" role="button" kandidat-id="' . $data->id . '" kandidat-no_urut="' . $data->no_urut . '"><i class="fa fa-trash"></i></a>
                            </div>
                    </div>';
                })
                ->rawColumns(['Aksi'])
                ->addIndexColumn()
                ->removeColumn('id')
                ->make(true);
        }


        return view('kandidat.index', compact('Title', 'Kandidat', 'Mahasiswa'));
    }

    public function store(Request $request)
    {
        //Validasi 
        $this->validate($request, [
            'no_urut' => 'required|numeric',
            'visi_misi' => 'required'
        ]);


        $no_urut = $request->no_urut;
        $calon_ketua = $request->calon_ketua;
        $calon_wakil = $request->calon_wakil;
        $visi_misi = $request->visi_misi;

        $data = new Kandidat;
        $data->no_urut = $no_urut;
        $data->calon_ketua = $calon_ketua;
        $data->calon_wakil = $calon_wakil;
        $data->visi_misi = $visi_misi;
        $data->save();

        return redirect()->back();
    }

    public function edit($id)
    {
        $Mahasiswa = M_mahasiswa::orderBy('nama', 'asc')->get();
        $Kandidat = Kandidat::find($id);
        // dd($Kandidat);
        return view('kandidat.editForm', compact('Kandidat', 'Mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        //Validasi 
        $this->validate($request, [
            'no_urut' => 'required|numeric',
            'visi_misi' => 'required'
        ]);

        $no_urut = $request->no_urut;
        $calon_ketua = $request->calon_ketua;
        $calon_wakil = $request->calon_wakil;
        $visi_misi = $request->visi_misi;

        $data = Kandidat::find($id);
        $data->no_urut = $no_urut;
        $data->calon_ketua = $calon_ketua;
        $data->calon_wakil = $calon_wakil;
        $data->visi_misi = $visi_misi;
        $data->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $Kandidat = Kandidat::findOrFail($id);
        $Kandidat->delete();

        return redirect()->back();
    }

    public function detail($id)
    {
        $Title = 'Detail Calon Ketua-Wakil BEM';
        $Mahasiswa = M_mahasiswa::find($id);
        $Kandidat =  Kandidat::find($id);
        return view('kandidat.detail', compact('Title', 'Mahasiswa', 'Kandidat'));
    }
}

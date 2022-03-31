<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\M_mahasiswa;
use App\Models\Kandidat;
use App\Models\Status;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\Exports\MahasiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class MahasiswaController extends Controller
{

    // public function __construct()
    // {
    //     $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
    // }

    public function index(Request $request)
    {
        $title = 'Daftar Mahasiswa';
        $mahasiswa = M_mahasiswa::orderBy('nama', 'asc')->get();
        // dd($mahasiswa);

        if ($request->ajax()) {
            return \datatables()->of($mahasiswa)
                ->addColumn('Aksi', function ($data) {
                    return '
                    <a href="" class="btn btn-warning btn-xs edit" role="button" data-id="' . $data->id . '"><i class="fa fa-edit"></i></a>

                    <a href="" class="btn btn-danger btn-xs delete" role="button" mahasiswa-id="' . $data->id . '" mahasiswa-nama="' . $data->nama . '"><i class="fa fa-trash"></i></a>
                    ';
                })
                ->rawColumns(['Aksi'])
                ->addIndexColumn()
                ->removeColumn('id')
                ->make(true);
        }

        return view('mahasiswa.index', compact('title'));
    }

    public function add()
    {
        $title = 'Tambah Mahasiswa';
        return view('mahasiswa.add', compact('title'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        //Validasi 
        $this->validate($request, [
            'nim' => 'required|min:8|numeric|unique:M_mahasiswa',
            'nama' => 'required',
            'foto' => 'image|nullable|mimes:jpeg,png,jpg|max:2000',
            'no_telp' => 'required|min:11|numeric',
            'alamat' => 'required'
        ]);

        $nim = $request->nim;
        $nama = $request->nama;
        $no_telp = $request->no_telp;
        $alamat = $request->alamat;

        $file = $request->file('foto')->store('');

        //Menambahkan user baru
        $user = new User;
        $user->role = 'mahasiswa';
        $user->name = $nama;
        $user->email = $nama;
        $user->nim = $nim;
        $user->foto = $file;
        $user->password = bcrypt('1234');
        $user->save();

        $data = new M_mahasiswa;
        $data->user_id = $user->id;
        $data->nim = $nim;
        $data->nama = $nama;
        $data->no_telp = $no_telp;
        $data->alamat = $alamat;
        $data->foto = $file;
        $data->save();


        return response()->json([
            'data' => $data
        ]);

        return redirect()->back();
    }

    public function edit($id)
    {
        $mahasiswa = M_mahasiswa::findOrFail($id);
        return view('mahasiswa.editForm', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validasi 
        $this->validate($request, [
            'nim' => 'required|min:8|numeric',
            'nama' => 'required',
            'foto' => 'image|nullable|mimes:jpeg,png,jpg|max:2000',
            'no_telp' => 'required|min:11|numeric',
            'alamat' => 'required'
        ]);


        $nim = $request->nim;
        $nama = $request->nama;
        $no_telp = $request->no_telp;
        $alamat = $request->alamat;

        $data = M_mahasiswa::findOrFail($id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = md5(time()) . '.' . $extension;
            $file->move('storage', $filename);
            $oldFilename = $data->foto;
            $data->foto = $filename;
            Storage::delete($oldFilename);
        } else {
            $filename = $data->foto;
        }

        $user = User::findOrFail($data->user_id);
        $user->email = $nama;
        $user->nim = $nim;
        $user->name = $nama;
        $user->foto = $filename;
        $user->save();

        $data->nim = $nim;
        $data->nama = $nama;
        $data->no_telp = $no_telp;
        $data->alamat = $alamat;
        $data->foto = $filename;
        // dd($data);
        $data->save();

        return response()->json([
            'data' => $data
        ]);

        return redirect()->back();
    }

    public function delete($id)
    {
        $mahasiswa = M_mahasiswa::findOrFail($id);
        $mahasiswa_id = $mahasiswa->id;
        // dd($mahasiswa_id);
        $cek = Kandidat::where('calon_ketua', $mahasiswa_id)->orWhere('calon_wakil', $mahasiswa_id)->count();
    
        if($cek > 0){
             return redirect()->back();
        } else {
            $foto = $mahasiswa->foto;
            Storage::delete($foto);
            $mahasiswa->delete();
            $mahasiswa->user()->delete();

            return redirect()->back();
        }

    }

    public function laporanExcel()
    {
        return Excel::download(new MahasiswaExport, 'Mahasiswa.xlsx');
    }

    public function laporanPdf()
    {
        // $pdf = PDF::loadHTML('<h1>TEST PDF</h1>'); //HTML FORMAT
        $mahasiswa = M_mahasiswa::all();
        $pdf = PDF::loadView('mahasiswa.viewpdf', compact('mahasiswa'));
        return $pdf->download('Mahasiswa.pdf');
    }
}

<?php

namespace App\Exports;

use App\Models\M_mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MahasiswaExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return M_mahasiswa::all();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Nim',
            'No Telp',
            'Alamat'
        ];
    }

    public function map($mahasiswa): array
    {
        return [
            $mahasiswa->nama,
            $mahasiswa->nim,
            $mahasiswa->no_telp,
            $mahasiswa->alamat
        ];
    }
}

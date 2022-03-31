<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <style>
        h1 {
            text-align: center;
            margin-bottom: 5px;
        }

        #mahasiswa {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #mahasiswa td,
        #mahasiswa th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #mahasiswa tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #mahasiswa tr:hover {
            background-color: #ddd;
        }

        #mahasiswa th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <h1>Daftar Mahasiswa</h1>
    <table class="table" id="mahasiswa">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nim</th>
                <th>No Telpon</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswa as $mhs)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->no_telp }}</td>
                <td>{{ $mhs->alamat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
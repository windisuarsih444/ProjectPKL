<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Nilai Siswa PT.MICRODATA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }
        .kop-surat img {
            width: 80px;
            position: absolute;
            left: 20px;
            top: 10px;
        }
        .kop-surat h1, .kop-surat h2, .kop-surat p {
            margin: 2px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .judul {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="kop-surat">
        <img src="logo_sekolah.png" alt="Logo Sekolah">
        <h1>PKL PT.MICRODATA INDONESIA 2025</h1>
        <h2>Kementerian Pendidikan dan Kebudayaan</h2>
        <p>Jl. Pendidikan No. 123, Bandar Lampung, Lampung, Kode Pos : 31122</p>
        <p>Telepon: (021) 12345678 | Email: info@ptmicrodata.sch.id</p>
    </div>
    
    <h2 class="judul">DAFTAR NILAI SISWA</h2>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Guru</th>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nilai as $key => $n)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $n->student->name }}</td>
                <td>{{ $n->teacher->name }}</td>
                <td>{{ $n->mapel->nama }}</td>
                <td>{{ $n->nilai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
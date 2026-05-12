<!DOCTYPE html>
<html>
<head>
    <title>Laporan Inspeksi</title>
    <style>
        table { width:100%; border-collapse: collapse; }
        table, th, td { border:1px solid black; }
        th, td { padding:8px; font-size:12px; }
        th { background:#f2f2f2; }
    </style>
</head>
<body>

<h3 style="text-align:center;">LAPORAN INSPEKSI</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Ruangan</th>
            <th>Kategori</th>
            <th>Hasil (%)</th>
        </tr>
    </thead>

    <tbody>
        @foreach($inspeksi as $i)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $i->tanggal }}</td>
            <td>{{ $i->ruangan->nama_ruangan ?? '-' }}</td>
            <td>{{ $i->kategori->nama_kategori ?? '-' }}</td>
            <td>{{ $i->hasil }}%</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Hasil Inspeksi</title>

    <style>

        body{
            font-family: sans-serif;
            font-size: 13px;
            color: #111827;
        }

        h2{
            margin-bottom: 5px;
        }

        .info{
            margin-bottom: 20px;
        }

        .info p{
            margin: 4px 0;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td{
            border: 1px solid #d1d5db;
            padding: 10px;
        }

        table th{
            background: #f3f4f6;
        }

        .kategori{
            background: #e5e7eb;
            font-weight: bold;
        }

        .ttd{
            margin-top: 50px;
            width: 100%;
        }

        .ttd td{
            border: none;
            text-align: center;
        }

        img{
            width: 120px;
            height: auto;
        }

    </style>

</head>
<body>

    <h2>HASIL INSPEKSI</h2>

    <div class="info">

        <p>
            <strong>Tanggal:</strong>
            {{ \Carbon\Carbon::parse($inspeksi->tanggal)->format('d M Y') }}
        </p>

        <p>
            <strong>Ruangan:</strong>
            {{ $inspeksi->ruangan->nama_ruangan ?? '-' }}
        </p>

        <p>
            <strong>Kategori:</strong>
            {{ $inspeksi->kategori->nama_kategori ?? '-' }}
        </p>

        <p>
            <strong>Hasil:</strong>
            {{ $inspeksi->hasil }}%
        </p>

    </div>

    @php

        $filtered = $subUraian->filter(function ($item) use ($jawaban) {

            return isset($jawaban[$item->id]);

        });

        $grouped = $filtered->groupBy(function ($item) {

            return $item->uraian->nama_uraian ?? 'Lainnya';

        });

    @endphp

    <table>

        <thead>

            <tr>
                <th width="5%">No</th>
                <th>Pertanyaan</th>
                <th width="25%">Jawaban</th>
            </tr>

        </thead>

        <tbody>

            @foreach($grouped as $uraian => $items)

                <tr>
                    <td colspan="3" class="kategori">
                        {{ $uraian }}
                    </td>
                </tr>

                @foreach($items as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $item->nama_sub_uraian }}
                        </td>

                        <td>
                            {{ $jawaban[$item->id] ?? '-' }}
                        </td>

                    </tr>

                @endforeach

            @endforeach

        </tbody>

    </table>

    <table class="ttd">

        <tr>

            <td>

                <p><strong>Petugas K3RS</strong></p>

                @if($inspeksi->ttd_k3rs)

                    <img src="{{ public_path($inspeksi->ttd_k3rs) }}">

                @endif

                <p>
                    {{ $inspeksi->nama_petugas_k3rs }}
                </p>

            </td>

            <td>

                <p><strong>Petugas Ruangan</strong></p>

                @if($inspeksi->ttd_ruangan)

                    <img src="{{ public_path($inspeksi->ttd_ruangan) }}">

                @endif

                <p>
                    {{ $inspeksi->nama_petugas_ruangan }}
                </p>

            </td>

        </tr>

    </table>

</body>
</html>
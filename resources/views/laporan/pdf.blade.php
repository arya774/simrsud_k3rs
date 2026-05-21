<!DOCTYPE html>
<html>
<head>
    <title>Laporan Inspeksi</title>

    <style>

        body{
            font-family: DejaVu Sans;
            font-size:11px;
            color:#000;
            margin:20px;
        }

        h3{
            text-align:center;
            margin-bottom:20px;
            font-size:18px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table,
        th,
        td{
            border:1px solid black;
        }

        th,
        td{
            padding:8px;
            font-size:11px;
            vertical-align:top;
        }

        th{
            background:#f2f2f2;
            text-align:center;
            font-weight:bold;
        }

        .center{
            text-align:center;
        }

        .kategori-box{
            line-height:1.6;
        }

        .badge{
            display:inline-block;
            padding:3px 8px;
            margin:2px;
            border-radius:12px;
            background:#eaeaea;
            font-size:10px;
        }

    </style>

</head>
<body>

<h3>
    LAPORAN INSPEKSI
</h3>

<table>

    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="15%">Tanggal</th>
            <th width="20%">Ruangan</th>
            <th width="40%">Kategori</th>
            <th width="20%">Hasil (%)</th>
        </tr>
    </thead>

    <tbody>

        @forelse($inspeksi as $i)

            @php
                $kategoriList = [];

                if(!empty($i->jawaban)){

                    $jawabanIds = array_keys(
                        is_array($i->jawaban)
                        ? $i->jawaban
                        : json_decode($i->jawaban, true) ?? []
                    );

                    $kategoriList =
                        \App\Models\SubUraian::with('uraian.kategori')
                        ->whereIn('id', $jawabanIds)
                        ->get()
                        ->pluck('uraian.kategori.nama_kategori')
                        ->unique()
                        ->filter()
                        ->values();
                }
            @endphp

            <tr>

                <td class="center">
                    {{ $loop->iteration }}
                </td>

                <td class="center">
                    {{ \Carbon\Carbon::parse($i->tanggal)->format('d-m-Y') }}
                </td>

                <td>
                    {{ $i->ruangan->nama_ruangan ?? '-' }}
                </td>

                <td class="kategori-box">

                    @forelse($kategoriList as $kat)

                        <span class="badge">
                            {{ $kat }}
                        </span>

                    @empty

                        -

                    @endforelse

                </td>

                <td class="center">
                    {{ $i->hasil ?? 0 }}%
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="5" class="center">
                    Tidak ada data laporan inspeksi
                </td>
            </tr>

        @endforelse

    </tbody>

</table>

</body>
</html> 
<!DOCTYPE html>
<html>
<head>
    <title>FORM HASIL INSPEKSI</title>

    <style>
        body{
            font-family: DejaVu Sans, "Times New Roman", serif;
            font-size:10px;
            margin:10px;
            color:#000;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th, td{
            border:1px solid #000;
            padding:3px 5px;
            vertical-align:top;
        }

        th{
            text-align:center;
            font-weight:bold;
        }

        .center{ text-align:center; }

        .kategori{
            font-weight:bold;
            background:#d9d9d9;
        }

        .uraian{ font-weight:bold; }

        .sub{ padding-left:15px; }

        .ruang-header{
            font-size:9px;
            line-height:1.2;
        }

        .check{
            font-size:12px;
            font-weight:bold;
        }

        .catatan{
            font-size:9px;
            line-height:1.4;
        }

        .header-box{
            margin-bottom:10px;
        }

        .header-box table td{
            border:none;
            padding:2px;
        }

        .title{
            font-size:14px;
            font-weight:bold;
            text-align:center;
            margin-bottom:10px;
        }
    </style>
</head>

<body>

@php
    $jawaban = is_array($inspeksi->jawaban)
        ? $inspeksi->jawaban
        : json_decode($inspeksi->jawaban ?? '[]', true);

    $catatanKategori = is_array($inspeksi->catatan_kategori ?? null)
        ? $inspeksi->catatan_kategori
        : json_decode($inspeksi->catatan_kategori ?? '[]', true);

    $groupedKategori = $subUraian->groupBy(
        fn($item) => $item->uraian->kategori->nama_kategori ?? 'Kategori'
    );

    $alphabet = range('A','Z');
    $noUraian = 1;
@endphp


<div class="title">
    FORM HASIL INSPEKSI
</div>

<div class="header-box">
    <table>
        <tr>
            <td width="15%"><strong>Tanggal</strong></td>
            <td width="35%">: {{ \Carbon\Carbon::parse($inspeksi->tanggal)->format('d M Y') }}</td>

            <td width="15%"><strong>Ruangan</strong></td>
            <td width="35%">: {{ $inspeksi->ruangan->nama_ruangan ?? '-' }}</td>
        </tr>

        <tr>
            <td><strong>Petugas K3RS</strong></td>
            <td>: {{ $inspeksi->nama_petugas_k3rs ?? '-' }}</td>

            <td><strong>Petugas Ruangan</strong></td>
            <td>: {{ $inspeksi->nama_petugas_ruangan ?? '-' }}</td>
        </tr>
    </table>
</div>


<table>
    <thead>
        <tr>
            <th rowspan="2" width="4%">No</th>
            <th rowspan="2">Uraian Inspeksi / Obyek Penilaian</th>

            <th colspan="2" class="ruang-header">
                Ruang:<br>
                {{ $inspeksi->ruangan->nama_ruangan ?? '-' }}
            </th>

            <th rowspan="2" width="20%">
                Keterangan
            </th>
        </tr>

        <tr>
            <th width="6%">Ya</th>
            <th width="6%">Tidak</th>
        </tr>
    </thead>

    <tbody>

    @foreach($groupedKategori as $namaKategori => $items)

        <tr>
            <td class="center kategori">
                {{ $alphabet[$loop->index] }}.
            </td>

            <td colspan="4" class="kategori">
                {{ strtoupper($namaKategori) }}
            </td>
        </tr>

        @php
            $groupedUraian = $items->groupBy(
                fn($x) => $x->uraian->nama_uraian ?? '-'
            );
        @endphp


        @foreach($groupedUraian as $namaUraian => $subItems)

            <tr>
                <td class="center">
                    {{ $noUraian++ }}
                </td>

                <td class="uraian">
                    {{ $namaUraian }}
                </td>

                <td></td>
                <td></td>
                <td></td>
            </tr>


            @foreach($subItems as $index => $sub)

                @php
                    $nilai = strtolower(trim($jawaban[$sub->id] ?? ''));

                    $baik = in_array($nilai, ['baik','ya']);
                    $tidak = in_array($nilai, ['tidak','tidak baik']);

                    $huruf = chr(97 + $index);

                    $kategoriId = optional(
                        optional($sub->uraian)->kategori
                    )->id;

                    $catatan =
                        $catatanKategori[$kategoriId]
                        ?? $inspeksi->keterangan
                        ?? '-';
                @endphp

                <tr>
                    <td></td>

                    <td class="sub">
                        {{ $huruf }}.
                        {{ $sub->nama_sub_uraian }}
                    </td>

                    <td class="center check">
                        {{ $baik ? '✓' : '' }}
                    </td>

                    <td class="center check">
                        {{ $tidak ? '✓' : '' }}
                    </td>

                    <td class="catatan">
                        {{ $index == 0 ? $catatan : '' }}
                    </td>
                </tr>

            @endforeach

        @endforeach
    @endforeach

    </tbody>
</table>


<br><br>

<table style="border:none; margin-top:20px;">
    <tr>
        <td style="border:none; text-align:center; width:50%;">
            Petugas K3RS
            <br><br>

            @if(!empty($inspeksi->ttd_k3rs))
                <img src="{{ $inspeksi->ttd_k3rs }}" width="100">
            @else
                <br><br><br>
            @endif

            <br>
            <strong>{{ $inspeksi->nama_petugas_k3rs ?? '-' }}</strong>
        </td>

        <td style="border:none; text-align:center; width:50%;">
            Petugas Ruangan
            <br><br>

            @if(!empty($inspeksi->ttd_ruangan))
                <img src="{{ $inspeksi->ttd_ruangan }}" width="100">
            @else
                <br><br><br>
            @endif

            <br>
            <strong>{{ $inspeksi->nama_petugas_ruangan ?? '-' }}</strong>
        </td>
    </tr>
</table>

</body>
</html>
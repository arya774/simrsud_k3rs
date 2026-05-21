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

        <?php $__empty_1 = true; $__currentLoopData = $inspeksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <?php
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
            ?>

            <tr>

                <td class="center">
                    <?php echo e($loop->iteration); ?>

                </td>

                <td class="center">
                    <?php echo e(\Carbon\Carbon::parse($i->tanggal)->format('d-m-Y')); ?>

                </td>

                <td>
                    <?php echo e($i->ruangan->nama_ruangan ?? '-'); ?>

                </td>

                <td class="kategori-box">

                    <?php $__empty_2 = true; $__currentLoopData = $kategoriList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>

                        <span class="badge">
                            <?php echo e($kat); ?>

                        </span>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>

                        -

                    <?php endif; ?>

                </td>

                <td class="center">
                    <?php echo e($i->hasil ?? 0); ?>%
                </td>

            </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

            <tr>
                <td colspan="5" class="center">
                    Tidak ada data laporan inspeksi
                </td>
            </tr>

        <?php endif; ?>

    </tbody>

</table>

</body>
</html><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/laporan/pdf.blade.php ENDPATH**/ ?>
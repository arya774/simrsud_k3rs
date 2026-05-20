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

<?php
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
?>


<div class="title">
    FORM HASIL INSPEKSI
</div>

<div class="header-box">
    <table>
        <tr>
            <td width="15%"><strong>Tanggal</strong></td>
            <td width="35%">: <?php echo e(\Carbon\Carbon::parse($inspeksi->tanggal)->format('d M Y')); ?></td>

            <td width="15%"><strong>Ruangan</strong></td>
            <td width="35%">: <?php echo e($inspeksi->ruangan->nama_ruangan ?? '-'); ?></td>
        </tr>

        <tr>
            <td><strong>Petugas K3RS</strong></td>
            <td>: <?php echo e($inspeksi->nama_petugas_k3rs ?? '-'); ?></td>

            <td><strong>Petugas Ruangan</strong></td>
            <td>: <?php echo e($inspeksi->nama_petugas_ruangan ?? '-'); ?></td>
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
                <?php echo e($inspeksi->ruangan->nama_ruangan ?? '-'); ?>

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

    <?php $__currentLoopData = $groupedKategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $namaKategori => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr>
            <td class="center kategori">
                <?php echo e($alphabet[$loop->index]); ?>.
            </td>

            <td colspan="4" class="kategori">
                <?php echo e(strtoupper($namaKategori)); ?>

            </td>
        </tr>

        <?php
            $groupedUraian = $items->groupBy(
                fn($x) => $x->uraian->nama_uraian ?? '-'
            );
        ?>


        <?php $__currentLoopData = $groupedUraian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $namaUraian => $subItems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr>
                <td class="center">
                    <?php echo e($noUraian++); ?>

                </td>

                <td class="uraian">
                    <?php echo e($namaUraian); ?>

                </td>

                <td></td>
                <td></td>
                <td></td>
            </tr>


            <?php $__currentLoopData = $subItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php
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
                ?>

                <tr>
                    <td></td>

                    <td class="sub">
                        <?php echo e($huruf); ?>.
                        <?php echo e($sub->nama_sub_uraian); ?>

                    </td>

                    <td class="center check">
                        <?php echo e($baik ? '✓' : ''); ?>

                    </td>

                    <td class="center check">
                        <?php echo e($tidak ? '✓' : ''); ?>

                    </td>

                    <td class="catatan">
                        <?php echo e($index == 0 ? $catatan : ''); ?>

                    </td>
                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>
</table>


<br><br>

<table style="border:none; margin-top:20px;">
    <tr>
        <td style="border:none; text-align:center; width:50%;">
            Petugas K3RS
            <br><br>

            <?php if(!empty($inspeksi->ttd_k3rs)): ?>
                <img src="<?php echo e($inspeksi->ttd_k3rs); ?>" width="100">
            <?php else: ?>
                <br><br><br>
            <?php endif; ?>

            <br>
            <strong><?php echo e($inspeksi->nama_petugas_k3rs ?? '-'); ?></strong>
        </td>

        <td style="border:none; text-align:center; width:50%;">
            Petugas Ruangan
            <br><br>

            <?php if(!empty($inspeksi->ttd_ruangan)): ?>
                <img src="<?php echo e($inspeksi->ttd_ruangan); ?>" width="100">
            <?php else: ?>
                <br><br><br>
            <?php endif; ?>

            <br>
            <strong><?php echo e($inspeksi->nama_petugas_ruangan ?? '-'); ?></strong>
        </td>
    </tr>
</table>

</body>
</html><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/inspeksi/pdf.blade.php ENDPATH**/ ?>
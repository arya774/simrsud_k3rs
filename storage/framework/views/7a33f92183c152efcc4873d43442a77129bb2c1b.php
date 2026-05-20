<!DOCTYPE html>
<html>
<head>

    <title>Hasil Inspeksi</title>

    <style>

        body{
            font-family: sans-serif;
            font-size: 13px;
            color: #111827;
            margin: 25px;
        }

        h2{
            margin-bottom: 5px;
            color: #111827;
        }

        .subtitle{
            margin-top: 0;
            color: #6b7280;
            font-size: 13px;
        }

        .info{
            margin-top: 20px;
            margin-bottom: 25px;
            padding: 15px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }

        .info p{
            margin: 6px 0;
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
            vertical-align: middle;
        }

        table th{
            background: #f3f4f6;
            font-weight: bold;
            text-align: center;
        }

        .kategori{
            background: #e5e7eb;
            font-weight: bold;
            color: #111827;
        }

        .badge-baik{
            background: #dcfce7;
            color: #166534;
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: bold;
            display: inline-block;
        }

        .badge-tidak{
            background: #fee2e2;
            color: #991b1b;
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: bold;
            display: inline-block;
        }

        .catatan{
            margin-top: 30px;
        }

        .catatan h4{
            margin-bottom: 10px;
            color: #111827;
        }

        .catatan-box{
            border: 1px solid #d1d5db;
            background: #f9fafb;
            border-radius: 8px;
            padding: 15px;
            line-height: 1.7;
            min-height: 60px;
        }

        .ttd{
            margin-top: 50px;
            width: 100%;
        }

        .ttd td{
            border: none;
            text-align: center;
            vertical-align: top;
        }

        img{
            width: 120px;
            height: auto;
            margin-top: 10px;
        }

        .footer{
            margin-top: 40px;
            text-align: right;
            color: #9ca3af;
            font-size: 11px;
        }

    </style>

</head>

<body>

    <h2>HASIL INSPEKSI</h2>

    <p class="subtitle">
        Laporan hasil pemeriksaan inspeksi ruangan
    </p>

    
    <div class="info">

        <p>
            <strong>Tanggal:</strong>
            <?php echo e(\Carbon\Carbon::parse($inspeksi->tanggal)->format('d M Y')); ?>

        </p>

        <p>
            <strong>Ruangan:</strong>
            <?php echo e($inspeksi->ruangan->nama_ruangan ?? '-'); ?>

        </p>

        <p>
            <strong>Petugas K3RS:</strong>
            <?php echo e($inspeksi->nama_petugas_k3rs ?? '-'); ?>

        </p>

        <p>
            <strong>Hasil:</strong>
            <?php echo e($inspeksi->hasil); ?>%
        </p>

    </div>

    <?php

        $filtered = $subUraian->filter(function ($item) use ($jawaban) {
            return isset($jawaban[$item->id]);
        });

        $grouped = $filtered->groupBy(function ($item) {
            return $item->uraian->nama_uraian ?? 'Lainnya';
        });

        $no = 1;

    ?>

    
    <table>

        <thead>

            <tr>

                <th width="5%">
                    No
                </th>

                <th>
                    Pertanyaan
                </th>

                <th width="25%">
                    Jawaban
                </th>

            </tr>

        </thead>

        <tbody>

            <?php $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uraian => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>

                    <td colspan="3" class="kategori">
                        <?php echo e($uraian); ?>

                    </td>

                </tr>

                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php

                        $value = strtolower(trim($jawaban[$item->id] ?? ''));

                        $isTidakBaik =
                            $value == 'tidak baik' ||
                            $value == 'tidak_baik' ||
                            $value == 'tidak';

                    ?>

                    <tr>

                        <td align="center">
                            <?php echo e($no++); ?>

                        </td>

                        <td>
                            <?php echo e($item->nama_sub_uraian); ?>

                        </td>

                        <td align="center">

                            <?php if($isTidakBaik): ?>

                                <span class="badge-tidak">
                                    Tidak Baik
                                </span>

                            <?php else: ?>

                                <span class="badge-baik">
                                    Baik
                                </span>

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>

    </table>

    
    <div class="catatan">

        <h4>
            Catatan Inspeksi
        </h4>

        <div class="catatan-box">

            <?php echo e($inspeksi->keterangan ?? 'Tidak ada catatan inspeksi.'); ?>


        </div>

    </div>

    
    <table class="ttd">

        <tr>

            
            <td>

                <p>
                    <strong>Petugas K3RS</strong>
                </p>

                <?php if(!empty($inspeksi->ttd_k3rs)): ?>

                    <img src="<?php echo e($inspeksi->ttd_k3rs); ?>">

                <?php else: ?>

                    <p>-</p>

                <?php endif; ?>

                <p>
                    <?php echo e($inspeksi->nama_petugas_k3rs ?? '-'); ?>

                </p>

            </td>

            
            <td>

                <p>
                    <strong>Petugas Ruangan</strong>
                </p>

                <?php if(!empty($inspeksi->ttd_ruangan)): ?>

                    <img src="<?php echo e($inspeksi->ttd_ruangan); ?>">

                <?php else: ?>

                    <p>-</p>

                <?php endif; ?>

                <p>
                    <?php echo e($inspeksi->nama_petugas_ruangan ?? '-'); ?>

                </p>

            </td>

        </tr>

    </table>

    <div class="footer">
        Dicetak otomatis oleh sistem inspeksi
    </div>

</body>
</html><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/inspeksi/pdf.blade.php ENDPATH**/ ?>
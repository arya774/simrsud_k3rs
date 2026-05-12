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
        <?php $__currentLoopData = $inspeksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td><?php echo e($i->tanggal); ?></td>
            <td><?php echo e($i->ruangan->nama_ruangan ?? '-'); ?></td>
            <td><?php echo e($i->kategori->nama_kategori ?? '-'); ?></td>
            <td><?php echo e($i->hasil); ?>%</td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

</body>
</html><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/laporan/pdf.blade.php ENDPATH**/ ?>
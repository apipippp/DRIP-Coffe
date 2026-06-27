<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pendapatan - DRIP*</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>
<body class="bg-cream p-4">
<div class="container" style="max-width: 800px;">
    <div class="card p-4" style="border: 2px solid var(--dark); border-radius: 4px; background: white;">
        <h4 class="fw-black mb-1">DETAIL PEMASUKAN</h4>
        <p class="text-secondary mb-3"><?= date('d F Y', strtotime($date)) ?></p>
        <hr style="border-top: 2px dashed var(--dark);">

        <?php if (empty($orders)): ?>
            <p class="text-muted">Tidak ada transaksi pada tanggal ini.</p>
        <?php else: ?>
            <?php $no = 1; ?>
            <?php foreach ($orders as $order): ?>
            <div class="mb-4 p-3" style="border: 2px solid var(--dark); border-radius: 4px; background: #f8f6f0;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="fw-bold mb-0">#<?= $order['queue_number'] ?></h5>
                    <span class="badge bg-success text-white border border-dark px-3 py-2" style="border-radius: 4px;">SELESAI</span>
                </div>
                <p class="small text-secondary mb-2">ID: <?= $order['id'] ?> | Meja <?= $order['table_number'] ?> | <?= $order['payment_method'] ?></p>

                <table class="table table-borderless table-sm mb-2">
                    <thead>
                        <tr class="border-bottom">
                            <th>Menu</th>
                            <th>Qty</th>
                            <th class="text-end">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($order['items'] as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td>x<?= $item['quantity'] ?></td>
                            <td class="text-end">Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between fw-bold pt-2 border-top">
                    <span>Total</span>
                    <span class="text-success">Rp <?= number_format($order['total'], 0, ',', '.') ?></span>
                </div>
            </div>
            <?php $no++; ?>
            <?php endforeach; ?>

            <hr style="border-top: 2px dashed var(--dark);">
            <div class="d-flex justify-content-between h5 fw-black">
                <span>TOTAL PENDAPATAN</span>
                <span class="text-red">Rp <?= number_format($total_revenue, 0, ',', '.') ?></span>
            </div>
        <?php endif; ?>

        <div class="mt-4">
            <a href="<?= site_url('kasir') ?>" class="btn btn-outline-dark w-100 py-3" style="border: 2px solid var(--dark); border-radius: 4px; font-weight: bold;">Kembali ke Dashboard</a>
        </div>
    </div>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - DRIP*</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>
<body class="bg-cream p-4">
<div class="container" style="max-width: 600px;">
    <div class="card p-4" style="border: 2px solid var(--dark); border-radius: 4px; background: white;">
        <h4 class="fw-bold mb-3">Detail Pesanan #<?= $order['queue_number'] ?></h4>
        <p class="text-secondary small">ID Pesanan: <?= $order['id'] ?> | Meja: <?= $order['table_number'] ?></p>
        <hr style="border-top: 2px dashed var(--dark);">
        
        <table class="table table-borderless">
            <thead>
                <tr class="border-bottom">
                    <th>Menu</th>
                    <th>Qty</th>
                    <th class="text-end">Harga</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($order['items'] as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td>x<?= $item['quantity'] ?></td>
                    <td class="text-end">Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        
        <hr style="border-top: 2px dashed var(--dark);">
        <div class="d-flex justify-content-between fw-bold mb-1">
            <span>Subtotal</span>
            <span>Rp <?= number_format($order['subtotal'], 0, ',', '.') ?></span>
        </div>
        <div class="d-flex justify-content-between small text-secondary mb-1">
            <span>Pajak (10%)</span>
            <span>Rp <?= number_format($order['tax'], 0, ',', '.') ?></span>
        </div>
        <div class="d-flex justify-content-between h4 fw-black text-red mt-2 pt-2 border-top">
            <span>Total</span>
            <span>Rp <?= number_format($order['total'], 0, ',', '.') ?></span>
        </div>
        
        <div class="mt-4 d-flex gap-2">
            <a href="javascript:window.close()" class="btn btn-outline-dark w-50 py-3" style="border: 2px solid var(--dark); border-radius: 4px; font-weight: bold;">Tutup</a>
            <a href="<?= site_url('kasir/print_struk/'.$order['id']) ?>" target="_blank" class="btn btn-dark w-50 py-3" style="border: 2px solid var(--dark); border-radius: 4px; font-weight: bold; background: var(--red); color: white;">Cetak Struk</a>
        </div>
    </div>
</div>
</body>
</html>
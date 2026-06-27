<!DOCTYPE html>
<html>
<head>
    <title>Struk</title>
    <style>
        body { font-family: monospace; width: 300px; margin: auto; }
        .text-center { text-align: center; }
        .line { border-top: 1px dashed #000; margin: 10px 0; }
    </style>
</head>
<body onload="window.print()">
    <div class="text-center">
        <h2>DRIP*</h2>
        <p>Purwokerto</p>
        <div class="line"></div>
        <p>Antrean #<?= $order['queue_number'] ?> | ID: <?= $order['id'] ?></p>
        <p>Meja <?= $order['table_number'] ?></p>
        <div class="line"></div>
        <?php foreach($order['items'] as $item): ?>
            <p><?= $item['name'] ?> x<?= $item['quantity'] ?> = Rp <?= number_format($item['price']*$item['quantity'], 0, ',', '.') ?></p>
        <?php endforeach; ?>
        <div class="line"></div>
        <h4>Total: Rp <?= number_format($order['total'], 0, ',', '.') ?></h4>
        <div class="line"></div>
        <p>Terima kasih!</p>
    </div>
</body>
</html>